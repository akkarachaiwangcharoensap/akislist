<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use App\Events\SaleItemSold;
use App\Events\SaleItemRemoved;

use App\Http\Requests\StoreRequest;

use App\User;

use App\SaleItem;
use App\StoreItem;
use App\StoreCategory;
use App\SaleItemMessage;

use App\GeoLocation;
use App\City;

use App\Utility\Geography\Country;
use App\Utility\Geography\Province;

use App\Province as ProvinceModel;

class StoreController extends Controller
{
	/**
	 * User's IP address
	 * @var string $ip
	 */
	protected $ip = '174.6.69.178';

	/**
	 * @constructor
	 */
	public function __construct()
	{
		// Disabled for testing/development
		$this->middleware('check_maximum_user_sale_item')
			->only(array(
				'showNew',
				'add'
			)
		);

		// Make sure the user is verified
		$this->middleware('check_confirmed_user')
			->except(array(
				'showConfirmation',
				'confirm',
				'resendConfirmation'
			)
		);

		// Initialize geolocation session
		if (Session::has('geolocation') == false) {
			$this->geolocation = new GeoLocation;
			Session::put('geolocation', $this->geolocation->get($this->ip));
		}

    	// Fallback when no connectivity for local development
    // 	if (Session::has('geolocation') == false) {
    // 		Session::put('geolocation', json_decode(json_encode(array(
				// 'region' => 'British Columbia',
				// 'city' => 'Burnaby',
				// 'country' => 'CA',
				// 'loc' => ''
	   //  	))));
    // 	}
	}

    /**
     * Show the store page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$saleItems = SaleItem::byAuthor();

    	$metadata = array(
    		'title' => 'AkisList | Profile | Store'
    	);

        return view('profile.store', array(
        	'geolocation' => Session::get('geolocation'),
    		'saleItems' => $saleItems,
    		'metadata' => $metadata,
    		'max' => SaleItem::MAX
        ));
    }

    /**
     * Show the new store page
     *
     * @return \Illuminate\Http\Response
     */
    public function showNew()
    {
    	$user = Auth::user();
    	$disk = Storage::disk('gcs');
		
		$categories = StoreCategory::all()->pluck('name', 'id');

    	$metadata = array(
    		'title' => 'AkisList | Profile | Store | New'
    	);

    	return view('profile.store.new', array(
    		'geolocation' => Session::get('geolocation'),
    		'categories' => $categories,
    		'metadata' => $metadata
    	));
    }

    /**
     * Show the upload page
     *
     * @param string $name
     * @param string $random
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpload($name, $random)
    {
    	$user = Auth::user();
    	$saleItem = SaleItem::byAuthorOne($random);
    	
    	if (!$saleItem) {
    		abort(404);
    	}

    	// Make sure the user can view the sale item
    	if (!$user->can('user.sale-item.edit', $saleItem)) {
    		abort(403, 'Access denied');
    	}

    	return view('profile.store.upload', array(
    		'uploads' => $saleItem->uploads
    	));
    }

    /**
     * Show the finish page
     *
     * @param string $name
     * @param string $random
     *
     * @return \Illuminate\Http\Response
     */
    public function showFinish($name, $random)
    {
    	$user = Auth::user();
    	$saleItem = SaleItem::byAuthorOne($random);

    	if (!$saleItem) {
    		abort(404);
    	}

    	// Make sure the user can view the sale item
    	if (!$user->can('user.sale-item.edit', $saleItem)) {
    		abort(403, 'Access denied');
    	}

    	return view('profile.store.finish', array(
    		'saleItem' => $saleItem
    	));
    }

    /**
     * Show the edit sale\ item page
     *
     * @param string $name
     * @param string $random
     *
     * @return \Illuminate\Http\Response
     */
    public function showEdit($name, $random)
    {
    	$user = Auth::user();
    	$categories = StoreCategory::all()->pluck('name', 'id');
    	
    	$name = reverse_str_slug($name);
    	$saleItem = SaleItem::byAuthorOne($random);

    	if (!$saleItem) {
    		abort(404);
    	}
 
    	// Make sure the user can view the sale item
    	if (!$user->can('user.sale-item.edit', $saleItem)) {
    		abort(403, 'Access denied');
    	}

    	$contacts = SaleItemMessage::where('to', $user->id)
    		->where('sale_item_id', $saleItem->id)
    		->where('active', true)
    		->get();

    	$contacts = $contacts->unique('from')
    		->map(function ($contact) {
				return $contact->sender;
	    	})
	    	->pluck('name', 'unique_string');

    	return view('profile.store.edit', array(
    		'saleItem' => $saleItem,
    		'categories' => $categories,
    		'geolocation' => Session::get('geolocation'),
    		'contacts' => $contacts
    	));
    }

    /**
     * Show the preview page
     * 
     * @param string $name
     * @param string $random
     *
     * @return \Illuminate\Http\Response
     */
    public function showPreview($name, $random)
    {
    	$user = Auth::user();
    	$name = reverse_str_slug($name);
    	$saleItem = SaleItem::byAuthorOne($random);

    	if (!$saleItem) {
    		abort(404);
    	}

    	// Make sure the user has the permission to view
    	// the preview of the post
    	if (!$user->can('user.sale-item.preview', $saleItem)) {
    		abort(403, 'Access denied');
    	}

    	$cityParts = explode(', ', $saleItem->location);
    	$cityName = $cityParts[0];
    	$provinceName = $cityParts[1];

    	$country = Session::get('geolocation')->country;
    	$province = ProvinceModel::getBy($provinceName, $country);

    	$location = (new GeoLocation)->getCity($cityName, $country, $province->code);

    	return view('profile.store.preview', array(
    		'saleItem' => $saleItem,
    		'location' => $location
    	));
    }
   		
   	/**
   	 * Post the sale item to the store
   	 *
   	 * @param Request $request
   	 * @param string $name
   	 * @param string $random
   	 *
   	 * @return \Illuminate\Http\Response
   	 */
   	public function post(Request $request, $name, $random)
   	{
   		$user = Auth::user();
   		$saleItem = SaleItem::byAuthorOne($random);

   		if (!isset($saleItem)) {
   			abort(404);
   		}

   		// Make sure the user has the permission to post the
   		// sale item post
   		if (!$user->can('user.sale-item.post', $saleItem)) {
   			abort(403, 'Access denied');
   		}

   		$data = array(
   			'live' => true
   		);

   		// Update the sale item
   		$saleItem->update($data);

   		return redirect()->route('profile.store');
   	}

   	/**
   	 * Save the sale item info
   	 * 
   	 * @param StoreRequest $request
   	 * @param string $name
   	 * @param string $random
   	 *
   	 * @return \Illuminate\Http\Response
   	 */
   	public function save(StoreRequest $request, $name, $random)
   	{
    	$user = Auth::user();
   		$validated = $request->validated();

   		$name = reverse_str_slug($name);
   		$saleItem = SaleItem::byAuthorOne($random);

   		if (!isset($saleItem)) {
   			abort (404);
   		}

   		// Make sure the user has the permission to save the
   		// sale item post
   		if (!$user->can('user.sale-item.save', $saleItem)) {
   			abort(403, 'Access denied');
   		}

   		$options = array();

   		// Sold to
   		if ($request->get('sold_to') != '0') {

   			$soldTo = User::where('unique_string', $request->get('sold_to'))->first();

   			if (!$soldTo) {
   				abort(404);
   			}

   			$options = array(
   				'sold_to' => $soldTo->id
   			);

   			// Dispatch sale item sold event
   			event(new SaleItemSold ($saleItem));
   		}

   		$data = array_merge($validated, $options);

   		// Update the sale item
   		$saleItem->update($data);

   		return redirect()->route('profile.store.sale-item.edit', array(
    		'name' => str_slug($saleItem->title),
    		'random' => $saleItem->unique_string
    	));
   	}

    /**
     * Store/Add new sale item
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(StoreRequest $request)
    {
    	$validated = $request->validated();

    	$random = rand(8,32);
    	$randomString = str_random($random);

    	$options = array(
    		'user_id' => Auth::user()->id,
    		'unique_string' => $randomString
    	);

    	$data = array_merge($request->all(), $options);

    	// Create the sale item
    	$saleItem = SaleItem::create($data);

    	return redirect()->route('profile.store.sale-item.upload', array(
    		'name' => str_slug($saleItem->title),
    		'random' => $saleItem->unique_string
    	));
    }

    /**
     * Delete a sale item
     * 
     * @param string $name
     * @param string $random
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $name, $random)
    {
    	$user = Auth::user();
    	$disk = Storage::disk('gcs');

    	$name = reverse_str_slug($name);
    	
    	$saleItem = SaleItem::byAuthorOne($random);

    	if (!$saleItem) {
    		abort(404);
    	}

    	// Make sure the user has the permission to delete the
    	// sale item post
    	if (!$user->can('user.sale-item.delete', $saleItem)) {
    		abort(403, 'Access denied');
    	}

    	$folder = $user->unique_string;
    	$uploads = $saleItem->uploads;

    	$types = array(
    		'image/png' => '.png',
    		'image/jpeg' => '.jpeg',
    		'image/jpg' => '.jpg'
    	);

    	// Remove all uploads
    	foreach ($uploads as $upload) {
    		$type = $types[$upload->file_type];
    		// https://storage.googleapis.com/akislist/public/uploads/images/{folder}/{name}
    		$target = $folder.'/images/'.$upload->unique_string.'-'.$upload->file_name.$type;

    		$disk->delete($target);
    		$upload->delete();
    	}

    	event(new SaleItemRemoved($saleItem));

    	return redirect()->route('profile.store');
    }

}







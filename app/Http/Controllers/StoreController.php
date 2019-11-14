<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GeoLocation;
use App\StoreCategory;
use App\SaleItem;
use App\ReportCategory;
use App\Report;

use App\City;
use App\Province as ProvinceModel;

use App\Http\Resources\GeoLocationResource;

use App\Utility\Geography\Country;
use App\Utility\Geography\Province;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\ReportRequest;

use Illuminate\Pagination\Paginator;

use App\Http\Controllers\Traits\SaleItemCacheTrait;

class StoreController extends Controller
{
	use SaleItemCacheTrait;

	/**
	 * Geolocation
	 * @var GeoLocation geolocation
	 */
	protected $geolocation;

	/**
	 * User's IP Address
	 * @var string $ip
	 */
	protected $ip;

	/**
	 * @constructor
	 */
	public function __construct()
	{
		$this->ip = '174.6.69.178';

		// Initialize geolocation session
		if (Session::has('geolocation') == false) {
			$this->geolocation = new GeoLocation;
			Session::put('geolocation', $this->geolocation->get($this->ip));
			
			// US: 24.113.168.225
			// Session::put('geolocation', $this->geolocation->get('24.113.168.225'));
		}

    	// dd (Session::get('geolocation'));

		// Initialize location session
		if (Session::has('location') == false) {
			$location = Session::get('geolocation')->city.', '.Session::get('geolocation')->region;
			Session::put('location', $location);
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

		$this->initializeCategories();
		$this->initializeReportReasons();
	}

    /**
     * Show the store
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$storeCategories = Cache::get('store.categories')->pluck('name', 'id');
    	$reportReasons = Cache::get('store.reportReasons');

    	$saleItems = $this->paginate($this->cacheSaleItems());

    	$metadata = array(
    		'title' => 'AkisList | Store'
    	);

    	return view('store', array(
    		'geolocation' => Session::get('geolocation'),
    		'location' => Session::get('location'),
    		'saleItems' => $saleItems,
    		'storeCategories' => $storeCategories,
    		'reportReasons' => $reportReasons,
    		'metadata' => $metadata
    	));
    }

    /**
     * @deprecated
     * Show page
     * Refer to: https://stackoverflow.com/questions/20974404/laravel-pagination-pretty-url
	 *
     * @param int $page
     * @return \Illuminate\Http\Response
     */
    // public function showPage($page = 1)
    // {
    // 	// Get sale items based on the give page
    // 	$saleItems = SaleItem::orderBy('created_at', 'desc')
    // 		->paginate(10, array('*'), 'page', $page);
    		
    // 	$storeCategories = StoreCategory::all()->pluck('name', 'id');
    // 	$reportReasons = ReportCategory::all();
    
    // 	return view('store', array(
    // 		'geolocation' => Session::get('geolocation'),
    // 		'storeCategories' => $storeCategories,
    // 		'saleItems' => $saleItems,
    // 		'reportReasons' => $reportReasons
    // 	));
    // }

    /**
     * Show searched category
     *
     * @param Request $request
     * @param string $category
     *
     * @return \Illuminate\Http\Response
     */
    public function showSearchCategory(Request $request, $category)
    {
    	$category = reverse_str_slug($category);
    	
    	$storeCategories = Cache::get('store.categories');
    	$reportReasons = Cache::get('store.reportReasons');

    	$storeCategory = $storeCategories->firstWhere('name', reverse_str_slug($category));
    	$saleItems = $this->paginate($this->cacheSaleItemsCategory(str_slug($category)));
    	
    	$storeCategories = $storeCategories->pluck('name', 'id');

    	$metadata = array(
    		'title' => 'AkisList | ' . $category
    	);

    	return view('store.search', array(
    		'geolocation' => Session::get('geolocation'),
    		'location' => Session::get('location'),
    		'storeCategories' => $storeCategories,
    		'storeCategory' => $storeCategory,
    		'saleItems' => $saleItems,
    		'reportReasons' => $reportReasons,
    		'metadata' => $metadata,
    	));
    }

    /**
     * Show searched keyword
     *
     * @param string $category
	 * @param string $keyword
     *
     * @return \Illuminate\Http\Response
     */
    public function showSearchKeyword($category, $keyword)
    {
    	$category = reverse_str_slug($category);

		$storeCategories = Cache::get('store.categories');
		$reportReasons = Cache::get('store.reportReasons');

    	$storeCategory = $storeCategories->firstWhere('name', reverse_str_slug($category));

    	$saleItems = $this->cacheSaleItemsCategory(str_slug($category));
    	$saleItems = $this->paginate($this->matchKeyword($saleItems, $keyword));

    	$storeCategories = $storeCategories->pluck('name', 'id');

    	$metadata = array(
    		'title' => 'AkisList | ' . $category . ' | ' . $keyword
    	);
  
    	return view('store.search', array(
    		'geolocation' => Session::get('geolocation'),
    		'location' => Session::get('location'),
    		'storeCategories' => $storeCategories,
    		'storeCategory' => $storeCategory,
    		'saleItems' => $saleItems,
    		'reportReasons' => $reportReasons,
    		'metadata' => $metadata
    	));
    }

    /**
     * Show sale items based on the searched keyword
     * 
     * @param SearchRequest $request
     * @return \Illuminate\Http\Response
     */
    public function search(SearchRequest $request)
    {
    	$validated = $request->validated();
	
		$data = $request->all();

		$categories = Cache::get('store.categories');
		$category = $categories->firstWhere('id', $data['category']);
		
		$keyword = isset($data['keyword']) ? $data['keyword'] : '';
    	$location = $data['location'];

    	// Change/store location in session
    	Session::put('location', $location);

    	return redirect()->route('store.search.keyword', array(
    		'category' => str_slug($category->name),
    		'keyword' => str_slug($keyword)
    	));
    }

    /**
     * Show sale item
     *
     * @param string $category
     * @param string $saleItem
     * @param string $uniqueString
     *
     * @return \Illuminate\Http\Response
     */
    public function showSaleItem($category, $saleItem, $uniqueString)
    {
    	$category = StoreCategory::where('name', reverse_str_slug($category))->first();

    	$saleItem = SaleItem::where('store_category_id', $category->id)
    		->where('title', reverse_str_slug($saleItem))
    		->where('unique_string', $uniqueString)
    		->first();

    	if (!$saleItem) {
    		abort(404);
    	}

    	$reportReasons = ReportCategory::all();

    	return view('store.sale-item', array(
    		'saleItem' => $saleItem,
    		'reportReasons' => $reportReasons,
    		'user' => $saleItem->author,
    	));
    }

    /**
     * Report a given sale item
     *
     * @param ReportRequest $request
     * @param string $category
	 * @param string $saleItem
	 * @param string $uniqueString
	 *
	 * @return \Illuminate\Http\Response
     */
    public function report(ReportRequest $request, $category, $saleItem, $uniqueString)
    {
    	// Validate incoming request
    	$request->validated();

    	$category = StoreCategory::where('name', reverse_str_slug($category))->firstOrFail();

    	$saleItem = SaleItem::where('store_category_id', $category->id)
    		->where('title', reverse_str_slug($saleItem))
    		->where('unique_string', $uniqueString)
    		->first();

    	if (!$saleItem) {
    		abort(404);
    	}

    	$user = Auth::user();

    	if (!$user->can('user.sale-item.report', $saleItem)) {
    		abort(403, 'Access denied');
    	}

    	$user = Auth::user();

    	$from = (isset($user) == false) ? null : $user->id;
    	$to = $saleItem->author->id;

    	$ip = $_SERVER['REMOTE_ADDR'];

    	$options = array(
    		'from' => $from,
    		'to' => $to,
    		'sale_item_id' => $saleItem->id,
    		'ip_address' => $ip
    	);

    	$data = array_merge($request->all(), $options);
    	
    	// Create a new report
    	Report::create($data);
    	
    	Session::flash('message', 'A report has been sent. Thank you for your cooperation.');

    	return redirect()->route('store');
    }
}











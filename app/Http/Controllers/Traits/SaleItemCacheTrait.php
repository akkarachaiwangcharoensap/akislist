<?php

namespace App\Http\Controllers\Traits;

use App\SaleItem;
use App\City;

use App\StoreCategory;
use App\ReportCategory;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Collection;
use Illuminate\Auth\Events\Registered;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait SaleItemCacheTrait
{
	/**
	 * Expires every given minutes
	 * @var string $expiresEvery
	 */
	protected $expiresEvery;

	/**
	 * Minutes
	 * @var int $minutes
	 */
	protected $minutes = 120;

	/**
	 * Country
	 * @var string $country
	 */
	protected $country;

	/**
	 * Location
	 * @var string $location
	 */
	protected $location;

	/**
	 * Initialize
	 * @return void
	 */
	public function initialize ()
	{
		$this->expiresEvery = now()->addMinutes($this->minutes);

		$this->country = Session::get('geolocation')->country;
		$this->location = str_replace(' ', '', strtolower(Session::get('location')));
	}

	/**
	 * Initialize categories
	 * @return void
	 */
	public function initializeCategories ()
	{
		$this->initialize ();
		// Caching store categories
	    if (!Cache::get('store.categories')) {
	    	Cache::put('store.categories', StoreCategory::all(), $this->expiresEvery);
	    }
	}

	/**
	 * Initialize report reasons
	 * @return void
	 */
	public function initializeReportReasons ()
	{
		$this->initialize ();

	    // Caching store report reasons
	    if (!Cache::get('store.reportReasons')) {
	    	Cache::put('store.reportReasons', ReportCategory::all(), $this->expiresEvery);
	    }
	}

	/**
	 * Initialize sale items by querying sale items
	 * @return Illuminate\Pagination\LengthAwarePaginator
	 */
	public function initializeSaleItems ()
	{
		$saleItems = SaleItem::where('live', true)
	    		->where('active', true)
	    		->where('country_code', $this->country)
	    		->orderBy('created_at', 'desc')
	    		->get();

	    return $this->build($saleItems);
	}

	/**
	 * Cache all sale items
	 * @return bool cached
	 */
	public function cacheSaleItems()
	{
		$this->initialize();
		
		// verify if store has cached the sale items or not.
    	if (
    		!Cache::get('store.saleItems') && 
    		!isset(Cache::get('store.saleItems')[$this->country])
    	) {
    		$saleItems = $this->initializeSaleItems();

    		$geoSaleItems = array(
    			$this->country => $saleItems
    		);

    		// Cache the sale items
    		Cache::put('store.saleItems', $geoSaleItems, $this->expiresEvery);
    	} 
    	// if store items does exist but on different country
    	else if (
    		Cache::get('store.saleItems') && 
    		!isset(Cache::get('store.saleItems')[$this->country])
    	) {
    		$saleItems = $this->initializeSaleItems();

    		$original = Cache::get('store.saleItems');
    		$original[$this->country] = $saleItems;

    		$new = $original;

    		Cache::put('store.saleItems', $new, $this->expiresEvery);
    	}

    	return Cache::get('store.saleItems')[$this->country];
	}


	/**
	 * Cache sale items based on category
	 *
	 * @param string $category
	 * @return Illuminate\Support\Collection
	 */
	public function cacheSaleItemsCategory ($category)
	{
		$this->initialize();
		$this->cacheSaleItems();

		// initialize or check if cached categorized sale items not exist, create a new one
		if (
			!Cache::get('store.saleItems.category') && 
			!isset(Cache::get('store.saleItems.category')[$this->country][$this->location][$category])
		) {
			// Caching new country
			if (!isset(Cache::get('store.saleItems.category')[$this->country])) {

				$cached = Cache::get('store.saleItems.category');
				$cached[$this->country] = array();
				
				$new = $cached;

				Cache::put('store.saleItems.category', $new, $this->expiresEvery);
			}

			// Caching new location
			if (!isset(Cache::get('store.saleItems.category')[$this->country][$this->location])) {

				$cached = Cache::get('store.saleItems.category');
				$cached[$this->country][$this->location] = array();

				$new = $cached;

				Cache::put('store.saleItems.category', $new, $this->expiresEvery);
			}

			$storeCategory = StoreCategory::where('name', reverse_str_slug($category))->first();

			if (!$storeCategory) {
				abort(404);
			}

			$saleItems = (Cache::get('store.saleItems')[$this->country]) ? Cache::get('store.saleItems')[$this->country] : collect(array());

			// Filter category and location
			$saleItems = $saleItems->filter(function ($saleItem) use ($storeCategory) {

				$location = strtolower(str_replace(' ', '', $saleItem->location));
				$match = $saleItem->category->id == $storeCategory->id && $location == $this->location;

				return $match;
			});

			// Example: $saleItems['CA']['vancouver,bc']['books']
    		$geoCategorizedSaleItems = array(
    			$this->country => array(
    				$this->location => array(
    					str_slug($storeCategory->name) => $saleItems
    				)
    			)
    		);

    		// Cache the categorized sale items
    		Cache::put('store.saleItems.category', $geoCategorizedSaleItems, $this->expiresEvery);
		}
		// if at least one category is cached, cache other category, if it has not been cached already
		else if (
			Cache::get('store.saleItems.category') && 
			!isset(Cache::get('store.saleItems.category')[$this->country][$this->location][$category])
		) {
			
			// Caching new country
			if (!isset(Cache::get('store.saleItems.category')[$this->country])) {

				$cached = Cache::get('store.saleItems.category');
				$cached[$this->country] = array();

				$new = $cached;

				Cache::put('store.saleItems.category', $new, $this->expiresEvery);
			}

			// if location is not found, create new location.
			if (!isset(Cache::get('store.saleItems.category')[$this->country][$this->location])) {

				$cached = Cache::get('store.saleItems.category');
				$cached[$this->country][$this->location] = array();

				$new = $cached;
					
				Cache::put('store.saleItems.category', $new, $this->expiresEvery);
			}

			$storeCategory = StoreCategory::where('name', reverse_str_slug($category))->first();
			
			if (!$storeCategory) {
				abort(404);
			}

			$saleItems = (Cache::get('store.saleItems')[$this->country]) ? Cache::get('store.saleItems')[$this->country] : collect(array());

			// Filter category and location
			$saleItems = $saleItems->filter(function ($saleItem) use ($storeCategory) {

				$location = strtolower(str_replace(' ', '', $saleItem->location));
				$match = $saleItem->category->id == $storeCategory->id && $location == $this->location;

				return $match;
			});

			// Point new category to cache
			$cached = Cache::get('store.saleItems.category');
			$cached[$this->country][$this->location][$category] = $saleItems;

			$new = $cached;

    		// Cache the categorized sale items
			Cache::put('store.saleItems.category', $new, $this->expiresEvery);
		}
			
		return Cache::get('store.saleItems.category')[$this->country][$this->location][$category];
	}

    /**
     * Build sale items memory caching
     *
     * @param Illuminate\Suupport\Collection $saleItems
     * @return Illuminate\Support\Collection
     */
    public function build (Collection $saleItems)
    {
    	if ($saleItems->isEmpty()) {
    		return;
    	}

    	// Removing relationship to stop query from executing...
    	foreach ($saleItems as $saleItem) {
    		$saleItem['category'] = $saleItem->category;
    		$saleItem['uploads'] = $saleItem->uploads;

    		$saleItem['uploads']->each(function ($upload) {
    			$upload['file'] = $upload->file;

    			// Normalize object's relations
    			$this->normalize($upload, array('file'));
    		});

    		// Normalize object's relations
    		$this->normalize($saleItem, array('category', 'uploads'));
    	}

    	return $saleItems;
    }

    /**
     * Search for values that matches the searched keyword
     *
     * @param Illuminate\Support\Collection $saleItems
     * @param string $keyword
     *
     * @return Illuminate\Support\Collection
     */
    public function matchKeyword (Collection $saleItems, $keyword)
    {
    	$keyword = reverse_str_slug($keyword);

    	$saleItems = $saleItems->filter(function ($saleItem) use ($keyword) {
			$matches = null;
			$content = str_replace(array(',', '.'), '', $saleItem->title.' '.$saleItem->keywords);

			// Match the keyword on words
			/**
			 * Example
			 * Keyword: apple
			 * Content: Selling this apple's watch. Cheap apple watch.
			 *
			 * Matches: apple not apple's
			 */
			$regex = '/\b('.$keyword.')\b/mi';

			preg_match_all($regex, $content, $matches);

			$isMatched = !empty($matches[0]);

			return ($isMatched) ? $saleItem : null;
		});

    	return $saleItems;
    }

    /**
     * Normalize relations properties
     * to stop query from happening when accessing the
     * relation fields
     *
     * @param Object $instance
     * @param array $properties
     *
     * @return void
     */
    public function normalize(Object $instance, $properties = array())
    {
    	if (empty($properties)) {
    		return;
    	}

    	$relations = $instance->getRelations();

    	// Clear all relations
    	foreach ($properties as $property) {
    		unset($relations[$property]);
    	}

    	// Update the instance relations
    	$instance->setRelations($relations);
    }

    /**
     * @see https://gist.github.com/vluzrmos/3ce756322702331fdf2bf414fea27bcb
	 * Paginate collection or array
	 *
	 * @param array|Collection      $items
	 * @param int   $perPage
	 * @param int  $page
	 * @param array $options
	 *
	 * @return LengthAwarePaginator
	*/
	public function paginate($items, $perPage = 6, $page = null, $options = [])
	{
		$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
		$items = $items instanceof Collection ? $items : Collection::make($items);
		return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
	}
}

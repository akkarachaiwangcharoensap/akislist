<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

use App\SaleItemMessage;
use App\StoreCategory;

class SaleItem extends Model
{
	/**
	 * Table
	 * @var string $table
	 */
	protected $table = 'sale_items';

	/**
	 * Maximum sale items per each account
	 * @var int MAX
	 */
	public const MAX = 50;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'store_category_id', 
        'title', 
        'description', 
        'price', 
        'keywords', 
        'location', 
        'country_code', 
        'unique_string', 
        'sold_to',
        'live'
    ];

    /**
     * Get author
     *
     * @return App\User $author
     */
    public function author()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get category
     * @return App\StoreCategory
     */
    public function category()
    {
    	return $this->belongsTo('App\StoreCategory', 'store_category_id');
    }

    /**
     * Get sold to
     * @return App\User
     */
    public function soldTo()
    {
    	return $this->belongsTo('App\User', 'sold_to');
    }

    /**
     * Get uploads
     * @return Collection App\Upload
     */
    public function uploads()
    {
    	return $this->hasMany('App\Upload', 'sale_item_id');
    }

    /**
     * Get all incoming messages
     * @return Collection App\Message
     */
    public function messages()
    {
    	$user = Auth::user();

    	return $this->hasMany('App\SaleItemMessage', 'sale_item_id')
    		->where('from', '!=', $user->id)
    		->orderBy('created_at', 'desc');
    }

    /**
     * Get all incoming messages and outgoing messages
     * @return Collection App\SaleItemMessage
     */
    public function conversations()
    {	
    	return $this->hasMany('App\SaleItemMessage', 'sale_item_id')
    		->orderBy('created_at', 'desc');
    }

    /**
     * Get conversation of incoming and outgoing messages
     * between one buyer and one seller
     *
     * @return Collection App\SaleItemMessage
     */
    public function getPrivateConversation ()
    {
    	$user = Auth::user();
    	
    	// from the user
    	$from = $this->conversations()
    		->where('from', $user->id)
    		->where('active', true)
    		->get();

    	// to the user
    	$to = $this->conversations()
    		->where('to', $user->id)
    		->where('active', true)
    		->get();

    	$conversations = $from->merge($to)->sortBy('created_at');

    	return $conversations;
    }

    /**
     * @see getPrivateConversation
     * 
     * Get conversations of incoming and outgoing messages
     * of one user
     *
     * @return Collection App\SaleItemMessage
     */
    public function getPrivateConversationOf(User $user)
    {	
    	// from the user
    	$from = $this->conversations()
    		->where('from', $user->id)
    		->where('active', true)
    		->get();

    	// to the user
    	$to = $this->conversations()
    		->where('to', $user->id)
    		->where('active', true)
    		->get();

    	$conversations = $from->merge($to)->sortBy('created_at');

    	return $conversations;
    }

    /**
     * Get conversations of incoming and outgoing messages
     * between multiple buyers and one seller
     *
     * Relationship: many-to-one
     * @return Collection App\SaleItemMessage
     */
    public function getMultipleConversations ()
    {
		$groups = $this->conversations()
			->where('active', true)
			->get()
			->groupBy('from');

		$conversations = $groups->reject(function ($group, $key) {
			return $key == $this->user_id;
		});

		// Return conversations, if the user's messages
		// are not needed to format to the conversations
		if (isset($groups[$this->user_id]) == false || $groups->has($this->user_id) == false) {
			return $conversations;
		}

		// user's messages
		$messages = $groups[$this->user_id];

		// Append user's messages to the correct conversations
		$messages->each(function ($message) use ($conversations, &$index) {
			if (isset($conversations[$message->to]) || $conversations->has($message->to)) {
				$conversations[$message->to]->push($message);
			} 
			// When the user is the first message, the conversation is lost because
			// each conversation based on the buyer.
			else {

				// Create the conversation based on the user's messages
				$messages = collect(array($message));
				$conversations->put($message->to, $messages);
			}
		});

		// Sort all conversations
		$conversations = $conversations->map(function ($conversation) {
			return $conversation->sortBy('created_at');
		});

    	return $conversations;
    }

    /**
     * Get sale items by the logged in user
     *
     * @return \Illuminate\Database\Eloquent\Collection $saleItems
     */
    public static function byAuthor()
    {
    	$saleItems = Self::where('user_id', Auth::user()->id)
    		->where('active', true)
    		->orderBy('created_at', 'desc')
    		->get();

    	return $saleItems;
    }

    /**
     * Get sale items by category
     *
     * @param string $category
     * @param (optional) int $paginate
     *
     * @return \Illuminate\Database\Eloquent\Collection $saleItems 
     */
    public static function byCategory($category, $paginate = 10)
    {
    	$category = StoreCategory::where('name', $category)->first();

    	if (!$category) {
    		abort(404);
    	}
    	
    	$saleItems = Self::where('store_category_id', $category->id)
    		->where('active', true)
    		->where('live', true)
    		->paginate($paginate);

    	return $saleItems;
    }

    /**
     * Get a sale item by the logged in user
     *
     * @param string $random
     * @return App\SaleItem $saleItem
     */
    public static function byAuthorOne($random)
    {
    	$saleItem = Self::where('user_id', Auth::user()->id)
    		->where('unique_string', $random)
    		->first();

    	return $saleItem;
    }
}



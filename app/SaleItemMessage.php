<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItemMessage extends Model
{
	/**
	 * Table
	 * @var string $table
	 */
    protected $table = 'sale_item_messages';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_item_id', 'from', 'to', 'message'
    ];

    /**
     * Sale Item
     * @return App\SaleItem
     */
    public function saleItem()
    {
    	return $this->belongsTo('App\SaleItem', 'sale_item_id');
    }

    /**
     * Sender / From
     * @return App\User
     */
    public function sender()
    {
    	return $this->belongsTo('App\User', 'from');
    }

    /**
     * Receiver / To
     * @return App\User
     */
    public function receiver()
    {
    	return $this->belongsTo('App\User', 'to');
    }
}

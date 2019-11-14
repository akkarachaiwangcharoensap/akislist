<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	/**
	 * Table
	 * @var string $table
	 */
    protected $table = 'reports';

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from', 'to', 'message', 'report_category_id', 'sale_item_id', 'ip_address'
    ];

    /**
     * Report Category
     * @return App\ReportCategory
     */
    public function category()
    {
    	return $this->belongsTo('App\ReportCategory', 'report_category_id');
    }

    /**
     * Sender
     * @return App\User
     */
    public function sender()
    {
    	return $this->belongsTo('App\User', 'from');
    }

    /**
     * Receiver
     * @return App\User
     */
    public function receiver()
    {
    	return $this->belongsTo('App\User', 'to');
    }

    /**
     * Sale Item
     * @return App\SaleItem
     */
    public function saleItem()
    {
    	return $this->belongsTo('App\SaleItem', 'sale_item_id');
    }
}






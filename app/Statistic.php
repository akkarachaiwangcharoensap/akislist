<?php

namespace App;

use Carbon\Carbon;

use App\User;
use App\SaleItem;
use App\Report;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	/**
	 * Get unique users (based on emails) based on given time period
	 * 
	 * @param string $start
	 * @param string $end
	 *
	 * @return Illuminate\Support\Collection $users
	 */
    public static function UniqueUsers ($start, $end)
    {
    	$users = User::where('created_at', '>=', $start)
    		->where('created_at', '<=', $end)
    		->get();

    	return $users;
    }

    /**
     * Get unique sale items baesd on given
     * time period
     *
     * @param string $start
     * @param string $end
     *
     * @return Illuminate\Support\Collection $saleItems
     */
    public static function UniqueSaleItems ($start, $end)
    {
    	$saleItems = SaleItem::where('created_at', '>=', $start)
    		->where('created_at', '<=', $end)
    		->get();

    	return $saleItems;
    }

    /**
     * Get sale item reports based on the given
     * time period
     *
     * @param string $start
     * @param string $end
     *
     * @return Illuminate\Support\Collection $reports
     */
    public static function SaleItemReports ($start, $end)
    {
    	$reports = Report::where('created_at', '>=', $start)
    		->where('created_at', '<=', $end)
    		->where('sale_item_id', '!=', null)
    		->get();

    	return $reports;
    }

    /**
     * Get deactivated sale items based on the given
     * time period
     *
     * @param string $start
     * @param string $end
     *
     * @return Illuminate\Support\Collection $saleItems
     */
    public static function SaleItemsDeleted ($start, $end)
    {
    	$saleItems = SaleItem::where('created_at', '>=', $start)
    		->where('created_at', '<=', $end)
    		->where('active', '=', false)
    		->get();

    	return $saleItems;
    }

    /**
     * Get user reports based on the given
     * time period
     *
     * @param string $start
     * @param string $end
     *
     * @return Illuminate\Support\Collection $reports
     */
    public static function UserReports ($start, $end)
    {
    	$reports = Report::where('created_at', '>=', $start)
    		->where('created_at', '<=', $end)
    		->where('sale_item_id', '=', null)
    		->get();

    	return $reports;
    }

    /**
     * Get total deals made
     *
     * @param string $start
     * @param string $end
     *
     * @return Illuminate\Support\Collection $saleItems
     */
    public static function TotalDealsMade ($start, $end)
    {
    	$saleItems = SaleItem::where('created_at', '>=', $start)
    		->where('created_at', '<=', $end)
    		->where('sold_to', '!=', null)
    		->get();

    	return $saleItems;
    }

}

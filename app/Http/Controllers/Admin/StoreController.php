<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Report;
use App\Criminal;
use App\SaleItem;

use App\Events\UserBanned;
use App\Events\SaleItemRemoved;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /**
     * Show the reported sale items
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$reports = Report::where('sale_item_id', '!=', null)
    		->get();

    	$reports = $reports
    		// ->reject(function ($report) {
    		// 	return $report->saleItem->active == false;
    		// })
    		->unique('to')
    		->sortByDesc('created_at');

    	return view('admin.sale-items.reported-details', array(
    		'reports' => $reports
    	));
    }

    /**
     * Deactivate sale item
     *
     * @param string $name
     * @param string $uniqueString
     *
     * @return \Illuminate\Http\Response
     */
    public function deactivate($name, $uniqueString)
    {
    	$user = Auth::user();
    	$saleItem = SaleItem::where('unique_string', $uniqueString)->first();

    	if (!$saleItem) {
    		abort(404);
    	}

    	if (!$user->can('user.admin.saleItem.deactivate', $saleItem)) {
    		abort(403, 'Access denied');
    	}

    	event(new SaleItemRemoved($saleItem));

    	return back()->with('success', 'The sale item post is banned.');
    }
}










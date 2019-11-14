<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

use App\User;
use App\Report;
use App\Criminal;
use App\Statistic;

use App\Events\UserBanned;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	/**
	 * Show the admin dashboard
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$year = Carbon::now()->year;
    	$month = Carbon::now()->month;
    	$today = Carbon::now()->day;

    	$todayBefore = Carbon::create($year, $month, $today, 0, 0, 0);
    	$todayNext = Carbon::create($year, $month, $today, 24, 0, 0);

    	// Daily
    	$daily = array(
    		'users' => Statistic::UniqueUsers($todayBefore->toDateTimeString(), $todayNext->toDateTimeString()),
    		'saleItems' => Statistic::UniqueSaleItems($todayBefore->toDateTimeString(), $todayNext->toDateTimeString()),
    		'saleItemsDeleted' => Statistic::SaleItemsDeleted($todayBefore->toDateTimeString(), $todayNext->toDateTimeString()),
    		'saleItemReports' => Statistic::SaleItemReports($todayBefore->toDateTimeString(), $todayNext->toDateTimeString()),
    		'userReports' => Statistic::UserReports($todayBefore->toDateTimeString(), $todayNext->toDateTimeString()),
    		'totalDealsMade' => Statistic::TotalDealsMade($todayBefore->toDateTimeString(), $todayNext->toDateTimeString()),
    	);

    	// Monthly
    	$before = $month;
    	$next = $month + 1;

    	// Previous monthly period
    	$previousBefore = Carbon::create($year, $before - 1, 1, 0, 0, 0);
    	$previousNext = Carbon::create($year, $next - 1, 1, 0, 0, 0);

    	// Current monthly period
    	$currentBefore = Carbon::create($year, $before, 1, 0, 0, 0);
    	$currentNext = Carbon::create($year, $next, 1, 0, 0, 0);

    	$monthly = array(
    		'previous' => array(
    			'users' => Statistic::UniqueUsers($previousBefore->toDateTimeString(), $previousNext->toDateTimeString()),
	    		'saleItems' => Statistic::UniqueSaleItems($previousBefore->toDateTimeString(), $previousNext->toDateTimeString()),
    			'saleItemsDeleted' => Statistic::SaleItemsDeleted($previousBefore->toDateTimeString(), $previousNext->toDateTimeString()),
	    		'saleItemReports' => Statistic::SaleItemReports($previousBefore->toDateTimeString(), $previousNext->toDateTimeString()),
	    		'userReports' => Statistic::UserReports($previousBefore->toDateTimeString(), $previousNext->toDateTimeString()),
	    		'totalDealsMade' => Statistic::TotalDealsMade($previousBefore->toDateTimeString(), $previousNext->toDateTimeString()),
    		),
    		'current' => array(
	    		'users' => Statistic::UniqueUsers($currentBefore->toDateTimeString(), $currentNext->toDateTimeString()),
	    		'saleItems' => Statistic::UniqueSaleItems($currentBefore->toDateTimeString(), $currentNext->toDateTimeString()),
    			'saleItemsDeleted' => Statistic::SaleItemsDeleted($currentBefore->toDateTimeString(), $currentNext->toDateTimeString()),
	    		'saleItemReports' => Statistic::SaleItemReports($currentBefore->toDateTimeString(), $currentNext->toDateTimeString()),
	    		'userReports' => Statistic::UserReports($currentBefore->toDateTimeString(), $currentNext->toDateTimeString()),
	    		'totalDealsMade' => Statistic::TotalDealsMade($currentBefore->toDateTimeString(), $currentNext->toDateTimeString()),
    		)
    	);

    	$growth = array(
    		'users' => count($monthly['current']['users']) - count($monthly['previous']['users']),
    		'saleItems' => count($monthly['current']['saleItems']) - count($monthly['previous']['saleItems']),
    		'saleItemsDeleted' => count($monthly['current']['saleItemsDeleted']) - count($monthly['previous']['saleItemsDeleted']),
    		'saleItemReports' => count($monthly['current']['saleItemReports']) - count($monthly['previous']['saleItemReports']),
    		'userReports' => count($monthly['current']['userReports']) - count($monthly['previous']['userReports']),
    		'totalDealsMade' => count($monthly['current']['totalDealsMade']) - count($monthly['previous']['totalDealsMade']),
    	);

    	return view('admin.home', array(
    		'daily' => $daily,
    		'monthly' => $monthly,
    		'growth' => $growth
    	));
    }

    /**
     * Show the reported users
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showUsersReported()
    {
    	$reports = Report::all();
    	$reports = $reports->unique('to')->sortByDesc('created_at');

    	return view('admin.users.reported', array(
    		'reports' => $reports
    	));
    }

    /**
     * Show the users reported details
     * @return \Illuminate\Http\Response
     */
    public function showUsersReportedDetails()
    {
    	$reports = Report::all();
    	$reports = $reports->unique('to')->sortByDesc('created_at');

    	return view('admin.users.reported-details', array(
    		'reports' => $reports
    	));
    }

    /**
     * Show the reported user
     *
     * @param string $name
     * @param string $uniqueString
     * @return \Illuminate\Http\Response
     */
    public function showUser($name, $uniqueString)
    {
    	$user = User::where('unique_string', $uniqueString)->first();

    	if (!$user) {
    		abort(404);
    	}

    	$saleItems = $user->getCommunication()->map(function ($message) {
    		return $message->saleItem;
    	});

    	return view('admin.users.user', array(
    		'user' => $user,
    		'saleItems' => $saleItems
    	));
    }

    /**
     * Deactivate the user
     *
     * @param string $name
     * @param string $uniqueString
     * 
     * @return \Illuminate\Http\Response
     */
    public function deactivate($name, $uniqueString)
    {
    	$user = Auth::user();
    	$to = User::where('unique_string', $uniqueString)->first();

    	if (!$user->can('user.admin.deactivate', $to)) {
    		abort(403, 'Access denied');
    	}

    	$to->active = false;
    	$to->save();

    	// Deactivate all sale items
    	event(new UserBanned($to));

    	return back()->with('success', 'The user is banned.');
    }

    /**
     * Criminalize a user, this list will be sent to federal authorization
     * such as FBI, or polices.
     *
     * @param string $name
     * @param string $uniqueString
     *
     * @return \Illuminate\Http\Response
     */
    public function criminalize($name, $uniqueString)
    {
    	$user = Auth::user();
    	$to = User::where('unique_string', $uniqueString)->first();

    	if (!$user->can('user.admin.criminalize', $to)) {
    		abort(403, 'Access denied');
    	}

    	$to->active = false;
    	$to->save();

    	// Deactivate all sale items
    	event(new UserBanned($to));

    	// Add to the list of criminals
    	$criminal = new Criminal;
    	$criminal->user_id = $to->id;
    	$criminal->save();

    	return back()->with('success', 'The user is added to criminals list');
    }
}










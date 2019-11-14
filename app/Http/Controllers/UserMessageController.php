<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\UserMessageRequest;

use App\User;
use App\SaleItem;
use App\SaleItemMessage;
use App\ReportCategory;

class UserMessageController extends Controller
{
	/**
	 * @constructor
	 */
	public function __construct()
	{
		$this->middleware('check_confirmed_user')
			->except(array(
				'showConfirmation',
				'confirm',
				'resendConfirmation'
			)
		);
	}
	
	/**
	 * Show the messages of the user
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
    	$user = Auth::user();

    	$saleItems = $user->getCommunication()->map(function ($message) {
    		return $message->saleItem;
    	});

    	$reportReasons = ReportCategory::all();

    	$metadata = array(
    		'title' => 'AkisList | Profile | Messages'
    	);

    	return view('profile.messages', array(
    		'user' => $user,
    		'saleItems' => $saleItems,
    		'reportReasons' => $reportReasons,
    		'metadata' => $metadata
    	));
	}

    /**
     * Send message to a user
     *
     * @param UserMessageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(UserMessageRequest $request)
    {
    	$validated = $request->validated ();

    	$user = Auth::user();
    	$to = User::where('unique_string', $request->get('to'))->first();
    	$saleItem = SaleItem::where('unique_string', $request->get('saleItem'))->first();

    	if (!$user->can('user.message.send', $to)) {
    		abort(403, 'Access denied');
    	}

    	$message = array(
    		'from' => $user->id,
    		'to' => $to->id,
    		'sale_item_id' => $saleItem->id,
    		'message' => $validated['message']
    	);

    	// Create new sale item message
    	SaleItemMessage::create($message);

		return back()->with('success', 'Your message has been sent.');
    }

	/**
	 * Deactivate the message
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
    public function delete(Request $request)
    {
    	$user = Auth::user();

    	// Verify if the user has the authority to do the action.
    	if (!$user->can('user.message.delete')) {
    		abort(403);
    	}

    	$message = SaleItemMessage::where('id', $request->get('message_id'))->first();
    	
    	// Throw exception if the message is not found.
    	if (!$message) {
    		abort(404);
    	}

    	$message->active = false;
    	$message->save();
    	
    	return back()->with('success', 'You deleted a message.');
    }
}







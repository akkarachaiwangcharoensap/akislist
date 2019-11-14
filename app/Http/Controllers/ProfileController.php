<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ReportRequest;

use App\Events\UserBanned;

use App\User;
use App\SaleItem;
use App\UserContact;

use App\Report;
use App\ReportCategory;

class ProfileController extends Controller
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
     * Show the profile page.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();

    	$metadata = array(
    		'title' => 'AkisList | Profile'
    	);

        return view('profile', array(
        	'metadata' => $metadata
        ));
    }

    /**
     * Show the edit page.
     * @return \Illuminate\Http\Response
     */
    public function showEdit()
    {
    	$metadata = array(
    		'title' => 'AkisList | Profile | Edit'
    	);

    	return view('profile.edit', array(
    		'metadata' => $metadata
    	));
    }

    /** 
     * Report the user
     * 
     * @param ReportRequest $request
     * @param string $uniqueString
     *
     * @return \Illuminate\Http\Response
     */
    public function report(ReportRequest $request, $uniqueString)
    {
    	// validate coming request
    	$request->validated();

    	$user = (Auth::user() != false) ? Auth::user() : null;
    	$to = User::where('unique_string', $uniqueString)->first();

    	$ip = $_SERVER['REMOTE_ADDR'];

    	$options = array(
    		'from' => $user->id,
    		'to' => $to->id,
    		'sale_item_id' => null,
    		'ip_address' => $ip
    	);

    	$data = array_merge($request->all(), $options);
    	
    	// Create a new report	
    	Report::create($data);
    	
    	Session::flash('success', 'A report has been sent. Thank you for your cooperation.');

    	return back();
    }

    /**
     * Save the profile
     * @param ProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function save(ProfileRequest $request)
    {
    	$validated = $request->validated();

    	$user = Auth::user();
    	$user->email = $validated['email'];
    		
    	// Send a new email confirmation, if the email is changed
    	if ($user->isDirty ('email')) {
    		
	    	$random = rand(100, 255);
	    	$confirmationToken = str_random($random);

    		$user->confirmed = false;
    		$user->confirmation_token = $confirmationToken;
    		
    		$user->save();

    		// Resend confirmation to the new email
    		$user->resend();
    	}

    	$ip = $_SERVER['REMOTE_ADDR'];

    	$options = array(
    		'ip' => $ip
    	);

    	$data = array_merge($validated, $options);
    	
    	$user->update($data);

    	return redirect()->route('profile.edit');
    }

    /**
     * Deactivate account
     *
     * @param Request $request
     * @return void
     */
    public function deactivate(Request $request)
    {
    	$user = Auth::user();

    	event(new UserBanned($user));

    	// Log user out
    	Auth::logout();

    	return redirect()->route('home');
    }

    /**
     * Show the settings page
     * @return \Illuminate\Http\Response
     */
    public function showSettings()
    {
    	$user = Auth::user();    	
    	
    	$metadata = array(
    		'title' => 'AkisList | Profile | Settings'
    	);
  
    	return view('profile.settings', array(
    		'user' => $user,
    		'metadata' => $metadata
    	));
    }

    /**
     * Show confirmation page
     * @return \Illuminate\Http\Response
     */
    public function showConfirmation()
    {
    	$user = Auth::user();

    	if ($user->confirmed && $user->active) {
    		return redirect()->route('profile');	
    	}

    	$metadata = array(
    		'title' => 'AkisList | Profile | Confirmation'
    	);

    	return view('profile.confirmation', array(
    		'metadata' => $metadata
    	));
    }

    /**
     * Confirm the profile
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function confirm($token)
    {
    	$user = Auth::user();

    	if ((bool) $user->confirmed) {
    		return redirect()->route('profile');
    	}
    	
    	$user->confirm($token);

    	return redirect()->route('profile');
    }

    /**
     * Resend confirmation to the user's email
     * @return \Illuminate\Http\Response
     */
    public function resendConfirmation()
    {
    	$user = Auth::user();
    	
    	if ((bool) $user->confirmed) {
    		return redirect()->route('profile');
    	}

    	$user->resend();

    	return redirect()->route('home');
    }
}




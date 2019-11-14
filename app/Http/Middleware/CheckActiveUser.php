<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$user = Auth::user();

    	// Stop the user to access the profile, if the account is deactivated
    	if ((bool) $user->active == false) {

    		Auth::logout();

    		return redirect()->route('home')
	    		->withErrors(
	    			array('account' => 'Your account has been deactivated. If you need further assistance, please send us an email.')
    			);
    	}

        return $next($request);
    }
}

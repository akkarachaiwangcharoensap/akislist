<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class CheckConfirmedUser
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

    	if ((bool)$user->confirmed == false) {
    		return redirect()->route('profile.confirmation.show');
    	}
    	
        return $next($request);
    }
}

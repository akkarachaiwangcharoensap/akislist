<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\SaleItem;
use App\SaleItemMessage;

use Closure;

class CheckNewSaleItemMessages
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

    	if ($user) {
	    	Session::put('messages', count($user->messages));
    	}

        return $next($request);
    }
}

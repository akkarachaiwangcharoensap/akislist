<?php

namespace App\Http\Middleware;

use Closure;
use App\SaleItem;

class CheckMaximumUserSaleItem
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
    	$saleItems = SaleItem::byAuthor();

    	if (count($saleItems) >= SaleItem::MAX) {

    		return redirect()->route('profile.store')
    			->withErrors(
    				array('store' => 'You have reached the maximum post of sale items.')
    			);
    	}

        return $next($request);
    }
}

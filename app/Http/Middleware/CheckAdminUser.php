<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use App\UserRole;
use Closure;

class CheckAdminUser
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
    	$user = (Auth::user()) ? Auth::user() : abort(404);

    	// If not an admin user, throw 404 exception
    	if ($user->role->id != UserRole::ADMIN) {
    		abort(404);
    	}

        return $next($request);
    }
}

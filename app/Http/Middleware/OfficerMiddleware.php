<?php

// phpcs:ignoreFile

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Redirect;

class officerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guest()) {
        //     return redirect('/Restricted');
        // } else {
        //     if ($request->user()->userRole == 1) {
        //         return redirect('/admin');
        //     } else {
        //         return $next($request);
        //     }
        // }

        if (Auth::guard($guard)->check()) {
            if ($request->user()->userRole == 1) {
                return $next($request);
            }

            return redirect('/RestrictedAuth');
        }

        if (Auth::guest()) {
            return redirect('/Restricted');
        }
    }
}

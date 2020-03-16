<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class LoggedInUser
{
    /**
     * Handle an incoming request.
     *
     * basic middleware to check if a user-id is set on the session
     * cannot upload images or reach dashboard without being logged in.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (empty(Session::get('user-id'))) {
            return redirect('/');
        }

        return $next($request);
    }
}

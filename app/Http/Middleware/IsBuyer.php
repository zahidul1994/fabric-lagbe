<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsBuyer
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
        if (Auth::check() && (Auth::user()->user_type == 'buyer' || Auth::user()->user_type == 'seller') ) {
            return $next($request);
        }
        else{
            session(['link' => url()->current()]);
            return redirect()->route('login');
        }
    }
}

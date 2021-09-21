<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $lvl = ['admin',];
        if(Auth::check() && in_array(Auth::user()->level,$lvl))
        {
            return $next($request);
        }
            //abort(403, 'Access denied');
            //return redirect()->route('login');
            return back()->withInput();
    }
}

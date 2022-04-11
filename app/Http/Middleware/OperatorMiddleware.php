<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OperatorMiddleware
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
        if (Auth::user()->role == 'operator') {
            return $next($request);            
        } else{
            $request->session()->flash('error','Unauthorized access');
            return redirect('login');
        }
    }
}

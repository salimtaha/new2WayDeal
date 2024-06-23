<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Approved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(auth()->user()->status === 'pending'){
            return SendResponse(403, 'Your account is not approved yet. We are working to get you verified');
        }elseif(auth()->user()->status === 'blocked'){
            return SendResponse(403, 'Your account is blocked. Please contact support for more information');
        }

        return $next($request);
    }
}

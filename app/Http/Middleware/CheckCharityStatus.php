<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCharityStatus
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
        if(Auth::guard('charity')->user()->status == "pending"||Auth::guard('charity')->user()->status == "blocked"||Auth::guard('charity')->user()->status == "canceld"){
            session()->flash('failed' , 'انتظر  يتم الفحص من قبل المسئول...');
            return redirect()->route('charities.wait');

        }elseif(Auth::guard('charity')->user()->status == "approved"){
            return $next($request);
        }
    }
}

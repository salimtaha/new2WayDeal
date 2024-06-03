<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if($request->is('admin/*')){
            return $request->expectsJson() ? null : route('admin.showLogin');
        }elseif($request->is('charities/*')){
            return $request->expectsJson() ? null : route('charities.showLogin');
        }elseif($request->is('mediators/*')){
            return $request->expectsJson() ? null : route('mediators.showLogin');
        };

        return $request->expectsJson() ? null : route('login');
    }
}

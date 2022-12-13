<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

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
        $login = '';
        dd($request);
        if (! $request->expectsJson()) {
            if (Route::is('staff.*')) {
                //return route('staff.login');
                $login = 'staff.login';
            } 

            if (Route::is('partners.*')) {
                //return route('partner.login');
                $login = 'partners.login';
            }
        }
        return route($login);
    }
}

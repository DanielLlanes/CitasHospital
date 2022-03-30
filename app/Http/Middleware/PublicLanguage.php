<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
//use Symfony\Component\HttpFoundation\Cookie;

class PublicLanguage 
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
        if (Cookie::has('PublicLang')) {
            app()->setLocale(Cookie::get('PublicLang'));
            return $next($request);
        }
        return $next($request)
            ->withCookie(Cookie::forever('PublicLang', app()->getLocale()));
    }
}

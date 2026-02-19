<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('admin/*') || $request->is('admin')) {
            app()->setLocale('id'); 
        } else {
            if (session()->has('locale')) {
                app()->setLocale(session('locale'));
            }
        }
        
        return $next($request);
    }
}

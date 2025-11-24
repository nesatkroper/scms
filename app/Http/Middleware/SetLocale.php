<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($locale = $request->session()->get('locale')) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}

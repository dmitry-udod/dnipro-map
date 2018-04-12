<?php

namespace App\Http\Middleware;

use Closure;

class OnlyValidCity
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
        $arrUrl = parse_url($request->url());
        
        if (!empty($arrUrl['host'])) {
            $citySlug = explode('.', $arrUrl['host'])[0];
            if (!empty($citySlug)) {
                $city = \App\City::where('slug', $citySlug)->firstOrFail();
                view()->share('city', $city);
                return $next($request);
            }
        }

        abort(404);
    }
}

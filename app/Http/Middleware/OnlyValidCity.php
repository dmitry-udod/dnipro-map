<?php

namespace App\Http\Middleware;

use App\Repositories\CategoryRepository;
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
                $categories = (new CategoryRepository())->allActiveForCity($city);

                view()->share('categories', $categories);
                view()->share('city', $city);
                view()->share('user', auth()->user());

                session()->put('currentCity', $city);

                return $next($request);
            }
        }

        abort(404);
    }
}

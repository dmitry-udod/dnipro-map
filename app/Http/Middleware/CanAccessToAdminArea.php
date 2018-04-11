<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CanAccessToAdminArea
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
        /** @var User $user */
        $user = $request->user();

        if (empty($user->roles)) {
            return redirect()->route('login');
        }

        if (! $request->user()->isSuperAdmin()) {
            return abort(403);
        }

        return $next($request);
    }
}

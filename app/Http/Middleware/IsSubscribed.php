<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string $subscription_name
     * @return mixed
     */
    public function handle($request, Closure $next, string $subscription_name = 'default')
    {
        if ($request->user() && (!$request->user()->subscribed($subscription_name) && !$request->user()->isAdmin())) {
            // This user is not a paying customer...
            return to_route('profile.index');
        }

        return $next($request);
    }
}

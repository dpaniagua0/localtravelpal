<?php

namespace App\Http\Middleware;

use Closure;

class RecruiterMiddleware
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
        $user = $request->user();
        if(!$user && !$user->hasRole('recruiter')){
            abort(403, 'Unauthorized action.');  
        } 
        return $next($request);
    }
}

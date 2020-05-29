<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!$request->user()->hasRole($role)) 
        {
            if ($request->expectsJson()) 
            {
                return response()->json(['message' => 'Not authorized.'], 403);
            } 
            else 
            {
                abort(404);
            }
        }
        
        return $next($request);
    }
}

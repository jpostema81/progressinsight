<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

// https://hotexamples.com/examples/tymon.jwtauth/JWTAuth/parseToken/php-jwtauth-parsetoken-method-examples.html

class Authenticate extends BaseMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if($request->expectsJson()) {
            return response()->json(['message' => 'U bent niet bevoegd om deze pagina te bezoeken'], 401);
        }

        return route('login');
    }

    /**
     * Handle an incoming request and validate JWT token
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws TokenException
     */
    public function handle($request, \Closure $next)
    {
        try 
        {
            $user = $this->auth->parseToken()->authenticate();
        } 
        catch(\Exception $e) 
        {
            if($e instanceof TokenInvalidException) 
            {
                return response()->json(['message' => 'Authentication Token is niet geldig'], 401);
            } 
            else if($e instanceof TokenExpiredException) 
            {
                return response()->json(['message' => 'Authentication Token is verlopen'], 401);
            } 
            else 
            {
                return response()->json(['message' => 'Authentication Token niet gevonden'], 401);
            }
        }

        return $next($request);
    }
}

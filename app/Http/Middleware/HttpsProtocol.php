<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

// the middleware will redirect every request to https if:
//
// * The current request comes with no secure protocol (http)
// * If your environment is equals to production. So, just adjust the settings according to your preferences.

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        Log::debug('$request->secure(): ' . $request->secure() ? 'true' : 'false');
        
        if (!$request->secure() && App::environment() === 'production') {
            Log::debug("redirecting from http to https");
            Log::debug('$request->secure(): ' . $request->secure());
            return redirect()->secure($request->getRequestUri());
        }

        Log::debug("no http to https redirect");
        return $next($request); 
    }
}
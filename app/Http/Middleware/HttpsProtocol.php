<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

// the middleware will redirect every request to https if:
//
// * The current request comes with no secure protocol (http)
// * If your environment is equals to production. So, just adjust the settings according to your preferences.

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
            if (!$request->secure() && App::environment() === 'production') {
                return redirect()->secure($request->getRequestUri());
            }

            return $next($request); 
    }
}
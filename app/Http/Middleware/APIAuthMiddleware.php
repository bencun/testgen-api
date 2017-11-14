<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;

class APIAuthMiddleware
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
        try {
            $jwt = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            $jwt = false;
        }
        if ($jwt) {
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }
    }
}

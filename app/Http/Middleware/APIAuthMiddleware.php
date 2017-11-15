<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\CustomException;

class APIAuthMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if($role=='admin' && !$user->admin) throw new CustomException("Inadequate privileges: not admin.");
            if($role=='user' && $user->admin) throw new CustomException("Inadequate privileges: not user.");
        }
        catch (JWTException $e){
            $user = false;
        }
        catch(CustomException $e){
            $user = false;
            return response()->json($e, 401);
        }

        if ($user) {
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }
    }
}

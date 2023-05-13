<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
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
            /** @var \PHPOpenSourceSaver\JWTAuth\JWTAuth $jwtAuth */
            $jwtAuth = JWTAuth::parseToken();//Получение токена

            //Проверка blacklist
            if ($jwtAuth->blacklist()->has($jwtAuth->payload())) {
                throw new TokenBlacklistedException();
            }

            $jwtAuth->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid'], 401);
            }

            if ($e instanceof TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired'], 401);
            }

            return response()->json(['status' => 'Authorization Token not found'], 401);
        }

        return $next($request);
    }
}

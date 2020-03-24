<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class Consumers
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
        return $next($request);
        $token = JWTAuth::getToken();
        $consumer = JWTAuth::toUser($token);

        if($consumer->account_type == 0 || $consumer->account_type == 1){
            $response = $next($request);
            $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
            $response->headers->set('charset', 'utf-8');
            return $response;
        }else{
            return response()->json('你不是客戶帳號，沒有此權限', 400);
        }
    }
}

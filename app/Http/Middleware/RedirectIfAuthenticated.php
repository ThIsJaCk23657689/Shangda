<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if($guard == 'api'){
                return response()->json([
                    'msg' => '您無權進入此頁面，因為您已經登入了。'
                ], 403);
            }else{
                return redirect('/');
            }
        }

        return $next($request);
    }
}

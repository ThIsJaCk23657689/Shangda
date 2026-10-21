<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureConsumerAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::guard('consumer')->check()) {
            return $request->expectsJson()
                ? response()->json(['message' => '請先登入顧客帳號。'], 401)
                : redirect()->guest(route('consumers.login'));
        }

        return $next($request);
    }
}

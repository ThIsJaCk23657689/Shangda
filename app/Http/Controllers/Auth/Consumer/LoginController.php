<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('frontend.consumers.auth.login');
    }

    public function login(Request $request): JsonResponse|RedirectResponse
    {
        $credentials = $request->validate([
            'account' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('consumer')->attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages(['account' => __('auth.failed')]);
        }

        $request->session()->regenerate();
        $consumer = Auth::guard('consumer')->user();
        Log::channel('consumers')->info("編號：{$consumer->id}，姓名：{$consumer->name} 已成功登入。");
        $url = redirect()->intended(route('index'))->getTargetUrl();

        return $request->expectsJson()
            ? response()->json(['redirect_url' => $url])
            : redirect()->to($url);
    }

    public function logout(Request $request): RedirectResponse
    {
        $consumer = Auth::guard('consumer')->user();
        Auth::guard('consumer')->logout();
        $request->session()->regenerateToken();

        if ($consumer) {
            Log::channel('consumers')->info("編號：{$consumer->id}，姓名：{$consumer->name} 已成功登出。");
        }

        return redirect()->route('index');
    }
}

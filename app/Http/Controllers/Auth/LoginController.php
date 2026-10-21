<?php

namespace App\Http\Controllers\Auth;

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
        return view('auth.login');
    }

    public function login(Request $request): JsonResponse|RedirectResponse
    {
        $credentials = $request->validate([
            'account' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages(['account' => __('auth.failed')]);
        }

        $request->session()->regenerate();
        $user = Auth::guard('web')->user();
        Log::channel('users')->info("編號：{$user->id}，姓名：{$user->name} 已成功登入。");
        $url = redirect()->intended(route('backend'))->getTargetUrl();

        return $request->expectsJson()
            ? response()->json(['redirect_url' => $url])
            : redirect()->to($url);
    }

    public function logout(Request $request): RedirectResponse
    {
        $user = Auth::guard('web')->user();
        Auth::guard('web')->logout();
        $request->session()->regenerateToken();

        if ($user) {
            Log::channel('users')->info("編號：{$user->id}，姓名：{$user->name} 已成功登出。");
        }

        return redirect()->route('index');
    }
}

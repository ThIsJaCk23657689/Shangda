<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, string $token): View
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->query('email')]);
    }

    public function reset(Request $request): JsonResponse|RedirectResponse
    {
        $credentials = $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);
        $status = Password::broker('users')->reset($credentials, function ($user, string $password): void {
            $user->forceFill(['password' => Hash::make($password), 'remember_token' => Str::random(60)])->save();
            event(new PasswordReset($user));
        });

        if ($status !== Password::PASSWORD_RESET) {
            return $request->expectsJson()
                ? response()->json(['message' => __($status)], 422)
                : back()->withErrors(['email' => __($status)]);
        }

        $url = route('login');
        return $request->expectsJson()
            ? response()->json(['message' => __($status), 'url' => $url])
            : redirect()->to($url)->with('status', __($status));
    }
}

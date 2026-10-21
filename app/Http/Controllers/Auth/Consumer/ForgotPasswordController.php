<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(): View
    {
        return view('frontend.consumers.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request): JsonResponse|RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);
        $status = Password::broker('consumers')->sendResetLink($request->only('email'));

        if ($status !== Password::RESET_LINK_SENT) {
            return $request->expectsJson()
                ? response()->json(['message' => __($status)], 422)
                : back()->withErrors(['email' => __($status)]);
        }

        return $request->expectsJson()
            ? response()->json(['message' => __($status)])
            : back()->with('status', __($status));
    }
}

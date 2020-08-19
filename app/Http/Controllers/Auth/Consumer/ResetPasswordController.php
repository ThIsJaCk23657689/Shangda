<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Auth;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest:consumer');
        $this->middleware('guest');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('frontend.consumers.auth.passwords.reset')->with([
            'token' => $token, 
            'email' => $request->email
        ]);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json([
            'message' => trans($response),
            'url' => redirect($this->redirectPath())->getTargetUrl(),
        ]);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json([
            'message' => trans($response)
        ], 422);
    }

    public function broker()
    {
        return Password::broker('consumers');
    }

    protected function guard()
    {
        return Auth::guard('consumer');
    }
}

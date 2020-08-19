<?php

namespace App\Http\Controllers\Auth\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:consumer');
        $this->middleware('guest');
    }
    
    public function showLinkRequestForm()
    {
        return view('frontend.consumers.auth.passwords.email');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'message' => trans($response)
        ]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'message' => trans($response)
        ], 422);
    }

    public function broker()
    {
        return Password::broker('consumers');
    }
}

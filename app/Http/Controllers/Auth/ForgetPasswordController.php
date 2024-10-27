<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    public function showLinkRequest()
    {
        $title = 'Reset Password';
        return view('auth.send-reset-email', compact('title'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status_send_email = Password::sendResetLink([
            'email' => $request->input('email')
        ]);
        return $status_send_email == Password::RESET_LINK_SENT 
        ? back()->with(['status' => __($status_send_email)])
        : back()->withErrors(['email' => __($status_send_email)]);
    }
}
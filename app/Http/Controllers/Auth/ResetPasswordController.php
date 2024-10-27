<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.reset-password',['token' => $token, 'title' => 'Form Reset Password']);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);

        $status = Password::reset([
            'email' => $request->input('email'),
            'password' =>$request->input('password'),
            'password_confirmation' =>$request->input('password_confirmation'),
            'token' =>$request->input('token'),
        ], function ($user, $password) {
            $user->password = Hash::make($password);
            $user->setRememberToken(Str::random(10));
            $user->save();  

            event(new PasswordReset($user));
        });

        return $status == Password::PASSWORD_RESET
        ? redirect()->route('login')->with(['status' => __($status)])
        : back()->withErrors(['status' => __($status)]);
    }
}
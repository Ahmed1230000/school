<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\sendResetLinkEmailFormRequest;
use Illuminate\Support\Facades\Password;

class SendResetPasswordController extends Controller
{
    public function sendEmail()
    {
        return view('auth.sendEmail');
    }

    public function sendResetLinkEmail(sendResetLinkEmailFormRequest $request)
    {
        $status = Password::sendResetLink($request->validated());

        return $status === Password::RESET_LINK_SENT
            ? redirect()->route('login')->with('success', 'Password has been reset successfully. You can now login.')
            : back()->withErrors(['email' => __($status)]);
    }
}

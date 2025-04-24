<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyOptFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Otp;

class OtpController extends Controller
{
    use CustomMessage, LogError;
    public function showOtpForm($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('auth.otp.verify', compact('user'));
    }

    public function verifyOtp(VerifyOptFormRequest $request)
    {
        try {
            $user = User::find($request->validated()['user_id']);

            if (!$user) {
                $this->flashMessage('error', 'User not found');
                return redirect()->back();
            }

            $otp = $user->otp()->where('is_used', false)
                ->where('otp_code', $request->validated()['otp_code'])
                ->where('expires_at', '>', now())
                ->latest()
                ->first();

            if ($otp) {
                $otp->is_used = true;
                $otp->save();

                $user->otp_verified_at = now();
                $user->save();
                $this->flashMessage('success', 'OTP verified successfully');
                return redirect()->back();
            }
            $this->flashMessage('error', 'Invalid OTP');
            return redirect()->route('home')->with('success', 'OTP verified successfully');
        } catch (\Exception $e) {
            $this->logError('Failed to verify OTP', ['error' => $e->getMessage()]);
            $this->flashMessage('error', 'Failed to verify OTP: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function resendOtp($user_id)
    {
        $user = User::findOrFail($user_id);
        $this->flashMessage('success', 'New OTP has been sent to your email');
        return redirect()->back();
    }
}

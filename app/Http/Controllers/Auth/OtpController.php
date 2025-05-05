<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyOptFormRequest;
use App\Jobs\SendOtpJob;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Otp;
use App\Service\OtpVerificationService;

class OtpController extends Controller
{
    use CustomMessage, LogError;

    protected $otpVerificationService;
    /**
     * OtpController constructor.
     *
     * @param OtpVerificationService $otpVerificationService
     */
    public function __construct(OtpVerificationService $otpVerificationService)
    {
        $this->otpVerificationService = $otpVerificationService;
    }
    public function showOtpForm($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('auth.otp.verify', compact('user'));
    }

    public function verifyOtp(VerifyOptFormRequest $request)
    {
        $user = User::where('id', $request->user_id)->first();

        $otpCode = $request->otp_code;

        if ($this->otpVerificationService->verifyOtp($user, $otpCode)) {
            $this->flashMessage('success', 'OTP verified successfully');
            return redirect()->route('login');
        } else {
            $this->flashMessage('error', 'Invalid or expired OTP');
            return redirect()->back();
        }
    }

    public function resendOtp($user_id)
    {
        $user = User::findOrFail($user_id);
        if (!$user) {
            $this->flashMessage('error', 'User not found');
            return redirect()->back();
        }
        SendOtpJob::dispatchSync($user->id);
        $this->flashMessage('success', 'New OTP has been sent to your email');
        return redirect()->back();
    }
}

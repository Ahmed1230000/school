<?php


namespace App\Service;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class OtpVerificationService extends OtpService
{
    public function verifyOtp(User $user, $otpCode)
    {
        $otp = $user->otp()->where('is_used', false)
            ->where('otp_code', $otpCode)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otp) {
            Log::warning('Invalid OTP attempt', ['user_id' => $user->id, 'otp_code' => $otpCode]);
            return false;
        }
        $otp->update(['is_used' => true]);

        $user->update(['otp_verified_at' => now()]);
        
        session()->forget('otp:user:id');

        Log::info('OTP verified successfully', ['user_id' => $user->id]);

        return true;
    }
}

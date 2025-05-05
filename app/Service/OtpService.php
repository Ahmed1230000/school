<?php


namespace App\Service;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Log;

class OtpService
{
    public  function generateOtp(User $user)
    {
        $otpCode = random_int(100000, 999999);
        return $user->otp()->create([
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'expires_at' => now()->addMinutes(5),
            'is_used' => false,
        ]);
    }

    public function sendOtp(User $user)
    {
        try {
            $otp = $this->generateOtp($user);

            Mail::to($user->email)->send(new SendOtpMail($otp->otp_code, $user));
            Log::info('OTP sent successfully', ['user_id' => $user->id]);
        } catch (\Throwable $e) {
            Log::error('Failed to send OTP', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
    
}

<?php

namespace App\Jobs;

use App\Mail\SendOtpMail;
use App\Models\User;
use App\Service\OtpService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOtpJob  implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(OtpService $otpService): void
    {
        $user = User::where('id', $this->user_id)->first();
        if (!$user) {
            Log::error('User not found', ['user_id' => $this->user_id]);
            return;
        }
        try {
            $otpService->sendOtp($user);
            Log::info('OTP sent successfully', ['user_id' => $this->user_id]);
        } catch (\Throwable $e) {
            Log::error('Failed to send OTP', [
                'user_id' => $this->user_id,
                'error' => $e->getMessage()
            ]);
        }
    }
}

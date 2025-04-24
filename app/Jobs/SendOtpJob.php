<?php

namespace App\Jobs;

use App\Mail\SendOtpMail;
use App\Models\User;
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

    protected $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $otp  = $this->user->otp()->create([
            'user_id' => $this->user->id,
            'otp_code' => random_int(100000, 999999),
            'expires_at' => now()->addMinutes(5),
            'is_used' => false,
        ]);

        Mail::to($this->user->email)->send(new SendOtpMail($otp->otp_code, $this->user));
    }
}

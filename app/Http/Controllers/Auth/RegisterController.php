<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterFormRequest;
use App\Jobs\SendOtpJob;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    use CustomMessage, LogError;
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(UserRegisterFormRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Automatically verify the email
            // event(new Registered($user));

            // Dispatch the job to send OTP
            SendOtpJob::dispatch($user);

            $this->flashMessage('success', 'Registration successful! Please Login to your account.');
            return redirect()->route('login');
        } catch (\Exception $e) {
            $this->logError('Registration failed', ['error' => $e->getMessage()]);
            $this->flashMessage('error', 'Registration failed: ');
            return redirect()->back();
        }
    }
}

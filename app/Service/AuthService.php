<?php


namespace App\Service;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Jobs\SendOtpJob;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthService
{
    use CustomMessage, LogError;

    protected $redirectTo = 'home';
    public function register(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
            SendOtpJob::dispatchSync($user->id);
            $this->flashMessage('success', 'Registration successful! Please verify your account.');
            return redirect()->route('otp.verifyForm', ['user_id' => $user->id]);
        } catch (\Throwable $e) {
            $this->logError('Registration failed', ['error' => $e->getMessage()]);
            $this->flashMessage('error', 'Registration failed: ');
            return redirect()->back();
        }
    }

    public function login(array $credentials)
    {
        try {
            if (!auth()->attempt($credentials)) {
                $this->flashMessage('error', 'Invalid Credentials');
                return redirect()->back();
            }
            $user = auth()->user();
            // $token = $user->createToken('auth_token')->accessToken;
            $this->flashMessage('success', 'Login Successful');
            
            if ($user->user_type === 'student' && !$user->student) {
                return redirect()->route('students.create');
            }
    
            return redirect()->route('home');
        } catch (\Throwable $e) {
            $this->logError('Login failed', ['error' => $e->getMessage()]);
            $this->flashMessage('error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        try {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $this->flashMessage('success', 'Logout Successful');
            return redirect()->route('login');
        } catch (\Throwable $e) {
            $this->logError('Logout failed', ['error' => $e->getMessage()]);
            $this->flashMessage('error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}

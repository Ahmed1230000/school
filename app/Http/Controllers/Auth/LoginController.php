<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ApiResponse;
use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginFormRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ApiResponse, CustomMessage, LogError;
    /**
     * Summary of showLoginForm
     */

    protected $redirectTo = 'home';
    public function showLoginForm()
    {
        return view('auth.login');
    }
    /**
     * Summary of __invoke
     * @param \App\Http\Requests\UserLoginFormRequest $request
     */
    public function login(UserLoginFormRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!auth()->attempt($credentials)) {
                $this->flashMessage('error', 'Invalid Credentials');
                return redirect()->back();
            }
            $user = auth()->user();
            $token = $user->createToken('auth_token')->accessToken;
            $this->flashMessage('success', 'Login Successful');
            return redirect()->route($this->redirectTo);
            // return $this->successMessage('You Are Logged in', [
            //     [
            //         'user' => $user,
            //         'token_type' => 'Bearer',
            //         'date' => now()->format('Y-m-d H:i:s'),
            //         'token' => $token
            //     ],
            // ], 200);
        } catch (\Exception $e) {
            $this->logError('Login failed', ['error' => $e->getMessage()]);
            $this->flashMessage('error', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}

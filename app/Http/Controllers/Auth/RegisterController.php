<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterFormRequest;
use App\Service\AuthService;

class RegisterController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(UserRegisterFormRequest $request)
    {
        return $this->authService->register($request->validated());
    }
}

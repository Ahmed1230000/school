<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginFormRequest;
use App\Service\AuthService;

class LoginController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Summary of showLoginForm
     */

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
        return $this->authService->login($request->validated());
    }
}

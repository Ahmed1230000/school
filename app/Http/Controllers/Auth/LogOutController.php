<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function showLogOutForm()
    {
        return view('auth.logOut');
    }
    public function logOut(Request $request)
    {
        $this->authService->logOut();
    }
}

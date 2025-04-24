<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    use LogError, CustomMessage;
    public function showLogOutForm()
    {
        return view('auth.logOut');
    }
    public function logOut(Request $request)
    {
        try {
            // Check if Passport token exists
            if ($request->user() && $request->user()->token()) {
                $request->user()->token()->revoke(); // Revoke token if using Passport
            }

            Auth::logout(); // Logout from web session too
            $request->session()->invalidate(); // optional but good practice
            $request->session()->regenerateToken(); // regenerate CSRF token

            $this->flashMessage('success', 'Logged out successfully');
            return redirect()->route('login');
        } catch (\Exception $e) {
            $this->logError('This Error !! =>' . $e->getMessage());
            $this->flashMessage('error', 'Something went wrong, please try again later');
            return redirect()->back();
        }
    }
}

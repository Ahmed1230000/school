<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendVerificationEmailFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\URL;
use App\Helpers\CustomMessage;
use App\Helpers\LogError;
use Illuminate\Support\Facades\Log;

class EmailVerificationController extends Controller
{
    use CustomMessage, LogError;

    /**
     * Send a verification email to the user or generate a verification link for testing.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendVerificationEmail(SendVerificationEmailFormRequest $request)
    {
        try {
            // Find the user by email
            $user = User::where('email', $request->validated())->first();

            // Check if user exists
            if (!$user) {
                $this->flashMessage('error', 'User not found');
                return redirect()->back();
            }

            // Check if email is already verified
            if ($user->hasVerifiedEmail()) {
                $this->flashMessage('info', 'Email already verified');
                return redirect()->back();
            }

            // Generate a temporary signed verification URL
            $url = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );

            // In production: Send this URL via email using Notification
            $this->flashMessage('success', 'Verification link generated. Please check your email.');
            $this->flashMessage('verification_url', $url);
            return redirect()->back();
        } catch (\Exception $e) {
            $this->logError('Failed to send verification email', ['error' => $e->getMessage()]);
            $this->flashMessage('error', 'Failed to send verification link: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Verify the user's email using the provided ID and hash.
     *
     * @param int $id The user's ID from the verification link
     * @param string $hash The hash from the verification link
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($id, $hash)
    {
        try {
            // Find the user by ID or throw an exception
            $user = User::findOrFail($id);

            // Check if the hash matches the user's email hash
            if (!hash_equals((string) $hash, (string) sha1($user->getEmailForVerification()))) {
                $this->flashMessage('error', 'Invalid verification link');
                return redirect()->route('login');
            }

            // Check if the email is already verified
            if ($user->hasVerifiedEmail()) {
                $this->flashMessage('info', 'Email already verified');
                return redirect()->route('login');
            }

            // Mark the email as verified and fire the Verified event
            $user->markEmailAsVerified();
            event(new Verified($user));

            // Return success response
            $this->flashMessage('success', 'Email verified successfully');
            return redirect()->route('login');
        } catch (\Exception $e) {
            $this->logError('Email verification failed', ['error' => $e->getMessage()]);
            // Return error response with exception message
            $this->flashMessage('error', 'Email verification failed: ' . $e->getMessage());
            return redirect()->route('login');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureTeacherIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user && $user->user_type === 'teacher' && !$user->canLogin()) {
            return redirect()->route('/')->withErrors([
                'message' => 'Your account is pending approval. Please contact the administrator for more information.',
            ]);
        }
        return $next($request);
    }
}

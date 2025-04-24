<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::post('/register', [RegisterController::class, 'register']);
// Route::post('/login', ['App\Http\Controllers\Auth\LoginController','login']);


// Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.reset');
// Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);

// Route::post('/send-verification-email', [EmailVerificationController::class, 'sendVerificationEmail']);
// Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
//     ->middleware('signed')
//     ->name('verification.verify');

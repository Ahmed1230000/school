<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{
    EmailVerificationController,
    LoginController,
    LogOutController,
    ResetPasswordController,
    RegisterController,
    SendResetPasswordController,
    OtpController
};
use App\Http\Controllers\RoleAndPermissions\{
    AssignPermissionToRoleController,
    AssignPermissionToUserController,
    PermissionController,
    RoleController,
    AssignRoleToUserController
};
use App\Http\Controllers\StudentController;

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');

    Route::get('/forgot-password', [SendResetPasswordController::class, 'sendEmail'])->name('password.request');
    Route::post('/forgot-password', [SendResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

    Route::get('/verify-otp/{user_id}', [OtpController::class, 'showOtpForm'])->name('otp.verifyForm');
    Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
    Route::post('/resend-otp/{user_id}', [OtpController::class, 'resendOtp'])->name('otp.resend');
});

Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware(['signed'])->name('verification.verify');
Route::post('/send-verification-email', [EmailVerificationController::class, 'sendVerificationEmail']);

// Route::get('/logout', [LogOutController::class, 'showLogOutForm'])->name('logout');
Route::post('/logout', [LogOutController::class, 'logOut'])->name('logout.perform');

Route::middleware(['auth'])->group(function () {
    Route::get('/', fn() => view('home'))->name('home');

    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);

    // Role to User
    Route::get('/assign-role-to-user', [AssignRoleToUserController::class, 'showAssignRoleToUserForm'])->name('assign-role-to-user.create');
    Route::post('/assign-role-to-user', [AssignRoleToUserController::class, 'assignRoleToUser'])->name('assign-role-to-user.store');
    Route::get('/revoke-role-from-user', [AssignRoleToUserController::class, 'showRevokeRoleToUserForm'])->name('revoke-role-from-user.show');
    Route::post('/revoke-role-from-user', [AssignRoleToUserController::class, 'revokeRoleFromUser'])->name('revoke-role-from-user.revoke');

    // Permission to Role
    Route::get('/assign-permission-to-role', [AssignPermissionToRoleController::class, 'showAssignPermissionToRoleForm'])->name('assign-permission-to-role.show');
    Route::post('/assign-permission-to-role', [AssignPermissionToRoleController::class, 'assignPermissionToRole'])->name('assign-permission-to-role.store');
    Route::get('/revoke-permission-from-role', [AssignPermissionToRoleController::class, 'showRevokePermissionToRoleForm'])->name('revoke-permission-from-role.show');
    Route::post('/revoke-permission-from-role', [AssignPermissionToRoleController::class, 'revokePermissionFromRole'])->name('revoke-permission-from-role.revoke');

    // Permission to User
    Route::get('/assign-permission-to-user', [AssignPermissionToUserController::class, 'showAssignPermissionToUserForm'])->name('assign-permission-to-user.show');
    Route::post('/assign-permission-to-user', [AssignPermissionToUserController::class, 'assignPermissionToUser'])->name('assign-permission-to-user.store');
    Route::get('/revoke-permission-from-user', [AssignPermissionToUserController::class, 'showRevokePermissionToUserForm'])->name('revoke-permission-from-user.show');
    Route::post('/revoke-permission-from-user', [AssignPermissionToUserController::class, 'revokePermissionFromUser'])->name('revoke-permission-from-user.revoke');

    // Student Management
    Route::resource('students', StudentController::class);
});

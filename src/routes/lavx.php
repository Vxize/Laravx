<?php

use Illuminate\Support\Facades\Route;
use Vxize\Lavx\Http\Controllers\User\{
    ChangeEmailController,
    ChangePasswordController,
    ConfirmPasswordController,
    EmailVerificationController,
    ForgetPasswordController,
    LoginController,
    LogoutController,
    ResetPasswordController,
    SignUpController,
};

Route::middleware(['web', 'guest'])->group(function () {
    // user login
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    
    // user signup
    Route::get('signup', [SignUpController::class, 'create'])->name('signup');
    Route::post('signup', [SignUpController::class, 'store']);

    // forget password
    Route::get('forgot-password', [ForgetPasswordController::class, 'create'])
                ->name('password.request');
    Route::post('forgot-password', [ForgetPasswordController::class, 'store'])
                ->name('password.email');

    // reset password
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'create'])
                ->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware(['web', 'auth'])->group(function () {
    // verify email
    Route::get('verify-email', [EmailVerificationController::class, 'notice'])
                ->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationController::class, 'send'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    // confirm password for security area
    Route::get('confirm-password', [ConfirmPasswordController::class, 'create'])
                ->name('password.confirm');
    Route::post('confirm-password', [ConfirmPasswordController::class, 'store']);

    // user logout
    Route::post('logout', [LogoutController::class, 'destroy'])->name('logout');

    // change email
    Route::resource('change-email', ChangeEmailController::class)
        ->only(['create', 'store']);
    // verify email change
    Route::get('/change-email-verify', [ChangeEmailController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('change_email_verify');

    // change password
    Route::resource('change-password', ChangePasswordController::class)
        ->only(['create', 'store']);

    // general form result
    Route::view('form-result', 'lavx::forms.result')->name('form.result');
});

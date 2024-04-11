<?php

use App\Http\Controllers\Lk\LkController;
use App\Http\Controllers\Lk\LoginController;
use App\Http\Controllers\Lk\Password\ForgotPasswordController;
use App\Http\Controllers\Lk\Password\ResetPasswordController;
use App\Http\Controllers\Lk\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {

	#login index
	Route::get('/login', [LoginController::class, 'index'])->middleware('redirect_if_auth')->name('login.index');

	#login
	Route::post('/login', [LoginController::class, 'login'])->name('login');

	#register index
	Route::get('/register', [RegisterController::class, 'index'])->middleware('redirect_if_auth')->name('register.index');

	#register
	Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});


//СБРОС ПАРОЛЯ
#forgot password index
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])
	->middleware('guest')
	->name('password.request');

#forgot password form (email)
Route::post('/forgot-password', [ForgotPasswordController::class, 'email'])
	->middleware('guest')
	->name('password.email');

#view new password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset'])
	->middleware('guest')
	->name('password.reset');

#update user password
Route::post('/reset-password', [ResetPasswordController::class, 'update'])
	->middleware('guest')
	->name('password.update');
//СБРОС ПАРОЛЯ


//ВЕРИФИКАЦИЯ E-mail
#view not verified
Route::get('/email/verify', function () {
	return view('lk.account.verify');
})->middleware(['auth', 'not_verified'])->name('verification.notice');

#verify from email letter
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	return redirect(defaultAccountPath());
})->middleware(['auth', 'signed'])->name('verification.verify');

# resent email
Route::post('/email/verification-notification', function (Request $request) {
	$request->user()->sendEmailVerificationNotification();
	session()->flash('success', 'Ссылка отправлена повторно!');
	return redirect()->back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//ВЕРИФИКАЦИЯ E-mail



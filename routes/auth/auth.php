<?php

use App\Http\Controllers\Lk\LoginController;
use App\Http\Controllers\Lk\Password\ForgotPasswordController;
use App\Http\Controllers\Lk\Password\ResetPasswordController;
use App\Http\Controllers\Lk\RegisterController;
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

	#logout
	Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
});

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




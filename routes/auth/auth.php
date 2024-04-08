<?php

use App\Http\Controllers\Lk\LoginController;
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

	#reset password index
	Route::get('/forget_password', [ResetPasswordController::class, 'index'])
		->middleware('guest')
		->name('forget_password');

	#reset password
	Route::post('/reset_password', [ResetPasswordController::class, 'reset'])
		->middleware('guest')
		->name('password_reset');
});

Route::post('/send_password', [ResetPasswordController::class, 'send'])->middleware('guest')->name('password.reset');
Route::post('/send_password', [ResetPasswordController::class, 'send'])->middleware('guest')->name('password.reset');

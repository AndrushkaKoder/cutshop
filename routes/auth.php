<?php

use App\Http\Controllers\Lk\LkController;
use App\Http\Controllers\Lk\LoginController;
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
	Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

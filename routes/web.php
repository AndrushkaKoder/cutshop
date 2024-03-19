<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return view('home.home');
});

Route::get('/login', function (\Illuminate\Support\Facades\Request $request) {
	return view('lk.login');
});

Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, ''])->name('post.login');

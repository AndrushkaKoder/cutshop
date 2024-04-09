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

#auth routes
include 'auth/auth.php';

#account routes
include 'lk/lk.php';

#application routes
Route::get('/', function () {
	return view('home.index');
})->name('home');






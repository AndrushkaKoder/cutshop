<?php

use App\Http\Controllers\Lk\LkController;
use Illuminate\Support\Facades\Auth;
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
	return view('home.index');
})->name('home');


Route::get('/lk/edit', [LkController::class, 'edit'])->middleware('auth')->name('user.lk.edit');
Route::post('/lk/update', [LkController::class, 'update'])->middleware('auth')->name('user.lk.update');
Route::post('/lk/destroy', [LkController::class, 'destroy'])->middleware('auth')->name('user.lk.destroy');

include 'auth.php';



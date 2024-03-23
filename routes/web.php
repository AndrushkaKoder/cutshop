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


Route::get('/lk/{id}/edit', [LkController::class, 'edit'])->middleware('auth')->name('user.lk.edit');
Route::post('/lk/{id}/update', [LkController::class, 'update'])->middleware('auth')->name('user.lk.update');

include 'auth.php';



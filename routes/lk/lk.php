<?php

use App\Http\Controllers\Lk\LkController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->middleware(['auth', 'verified'])->group(function () {
	Route::get('/lk/edit', [LkController::class, 'edit'])->name('lk.edit');
	Route::post('/lk/update', [LkController::class, 'update'])->name('lk.update');
	Route::post('/lk/destroy', [LkController::class, 'destroy'])->name('lk.destroy');
});

Route::get('/logout', [LkController::class, 'logout'])->middleware('auth')->name('user.logout');


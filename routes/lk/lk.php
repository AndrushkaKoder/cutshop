<?php

use App\Http\Controllers\Lk\LkController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
	Route::get('/lk/edit', [LkController::class, 'edit'])->middleware('auth')->name('user.lk.edit');
	Route::post('/lk/update', [LkController::class, 'update'])->middleware('auth')->name('user.lk.update');
	Route::post('/lk/destroy', [LkController::class, 'destroy'])->middleware('auth')->name('user.lk.destroy');

});


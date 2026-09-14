<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
require __DIR__.'/auth.php';

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Modulo ajustes
Route::get('/admin/ajustes', [\App\Http\Controllers\AjusteController::class, 'index'])->name('admin.ajustes.index')->middleware('auth');
Route::post('/admin/ajustes/create', [\App\Http\Controllers\AjusteController::class, 'store'])->name('admin.ajustes.store')->middleware('auth');



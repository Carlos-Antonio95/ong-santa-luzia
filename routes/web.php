<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdosasController;
use App\Http\Controllers\ResponsaveisController;
use App\Http\Controllers\PlanoIndividualsController;
use App\Http\Controllers\TermoAbrigamentosController;

Route::view('/', 'welcome')->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::resource('idosas', IdosasController::class);
    Route::resource('responsaveis', ResponsaveisController::class);
    Route::resource('planos', PlanoIndividualsController::class);
    Route::resource('termos', TermoAbrigamentosController::class);
});

require __DIR__.'/settings.php';
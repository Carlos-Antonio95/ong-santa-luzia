<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\IdosaController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\PlanoIndividualController;
use App\Http\Controllers\TermoAbrigamentoController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


/*
|--------------------------------------------------------------------------
| Rotas Protegidas (precisa estar logado)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard (ADMIN)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // CRUDs
    Route::resource('idosas', IdosaController::class);
    Route::resource('responsaveis', ResponsavelController::class);
    Route::resource('planos', PlanoIndividualController::class);
    Route::resource('termos', TermoAbrigamentoController::class);

});


/*
|--------------------------------------------------------------------------
| Rotas de autenticação (se estiver usando Breeze)
|--------------------------------------------------------------------------
*/

//require __DIR__.'/auth.php';

Route::get('/dashboard', [IdosaController::class, 'dashboard']);
Route::post('/idosas', [IdosaController::class, 'store']);
Route::delete('/idosas/{id}', [IdosaController::class, 'destroy']);
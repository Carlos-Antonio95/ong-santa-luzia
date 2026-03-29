<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\IdosaController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\PlanoIndividualController;
use App\Http\Controllers\TermoAbrigamentoController;
use App\Http\Controllers\PdfIdosaController;

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



Route::get('/dashboard', [IdosaController::class, 'dashboard'])->name('dashboard');

Route::post('/idosas', [IdosaController::class, 'store'])->name('idosas.store');
Route::put('/idosas/{idosa}', [IdosaController::class, 'update'])->name('idosas.update');
Route::delete('/idosas/{idosa}', [IdosaController::class, 'destroy'])->name('idosas.destroy');

Route::post('/idosas/{idosa}/plano', [PlanoIndividualController::class, 'storeOrUpdate'])->name('plano.storeOrUpdate');
Route::post('/idosas/{idosa}/termo', [TermoAbrigamentoController::class, 'storeOrUpdate'])->name('termo.storeOrUpdate');



Route::get('/idosas/{idosa}/pdf/cadastro', [PdfIdosaController::class, 'cadastro'])->name('idosas.pdf.cadastro');
Route::get('/idosas/{idosa}/pdf/plano', [PdfIdosaController::class, 'plano'])->name('idosas.pdf.plano');
Route::get('/idosas/{idosa}/pdf/termo', [PdfIdosaController::class, 'termo'])->name('idosas.pdf.termo');
Route::get('/idosas/{idosa}/pdf/completo', [PdfIdosaController::class, 'completo'])->name('idosas.pdf.completo');
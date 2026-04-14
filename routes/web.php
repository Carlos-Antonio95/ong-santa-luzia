<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdosaController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\PlanoIndividualController;
use App\Http\Controllers\TermoAbrigamentoController;
use App\Http\Controllers\PdfIdosaController;
use App\Http\Controllers\DoadorController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\UserSettingsController;



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
| Rotas Protegidas (LOGIN OBRIGATÓRIO)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [IdosaController::class, 'dashboard'])
        ->name('dashboard');

    // CRUDs principais
    Route::resource('idosas', IdosaController::class);
    Route::resource('responsaveis', ResponsavelController::class);
    Route::resource('planos', PlanoIndividualController::class);
    Route::resource('termos', TermoAbrigamentoController::class);

    // Ações extras
    Route::post('/idosas/{idosa}/plano', [PlanoIndividualController::class, 'storeOrUpdate'])
        ->name('plano.storeOrUpdate');

    Route::post('/idosas/{idosa}/termo', [TermoAbrigamentoController::class, 'storeOrUpdate'])
        ->name('termo.storeOrUpdate');

    // PDFs individuais
    Route::get('/idosas/{idosa}/pdf/cadastro', [PdfIdosaController::class, 'cadastro'])
        ->name('idosas.pdf.cadastro');

    Route::get('/idosas/{idosa}/pdf/plano', [PdfIdosaController::class, 'plano'])
        ->name('idosas.pdf.plano');

    Route::get('/idosas/{idosa}/pdf/termo', [PdfIdosaController::class, 'termo'])
        ->name('idosas.pdf.termo');

    Route::get('/idosas/{idosa}/pdf/completo', [PdfIdosaController::class, 'completo'])
        ->name('idosas.pdf.completo');

    // PDF da lista geral
    Route::get('/idosas/pdf/lista', [PdfIdosaController::class, 'lista'])
        ->name('idosas.pdf.lista');

    // CRUD de voluntários (Sprint 1 e 2)
    Route::resource('voluntarios', App\Http\Controllers\VoluntarioController::class);

    Route::resource('doadores', DoadorController::class);
    Route::resource('doacoes', DoacaoController::class)->except(['store']);

    Route::post('/doadores/{doador}/doacoes', [DoacaoController::class, 'store'])->name('doacoes.store');

    // Registro de usuário via dashboard (autenticado)
    Route::get('/register-user', [RegisterUserController::class, 'create'])->name('register.user');
    Route::post('/register-user', [RegisterUserController::class, 'store'])->name('register.user.store');

   // Configurações do usuário (Sprint 4)
   Route::post('/settings', [UserSettingsController::class, 'update'])->name('settings.update');
});


/*
|--------------------------------------------------------------------------
| Autenticação (Fortify já cuida disso automaticamente)
|--------------------------------------------------------------------------
*/

// NÃO PRECISA disso:
// require __DIR__.'/auth.php';
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\IdosaController;
use App\Http\Controllers\PlanoIndividualController;
use App\Http\Controllers\TermoAbrigamentoController;
use App\Http\Controllers\PdfIdosaController;
use App\Http\Controllers\DoadorController;
use App\Http\Controllers\DoacaoController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\VoluntarioController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [IdosaController::class, 'dashboard'])->name('dashboard');

    Route::resource('idosas', IdosaController::class)->only(['store', 'show', 'update', 'destroy']);

    Route::post('/idosas/{idosa}/plano', [PlanoIndividualController::class, 'storeOrUpdate'])
        ->name('plano.storeOrUpdate');

    Route::post('/idosas/{idosa}/termo', [TermoAbrigamentoController::class, 'storeOrUpdate'])
        ->name('termo.storeOrUpdate');

    Route::get('/idosas/{idosa}/pdf/cadastro', [PdfIdosaController::class, 'cadastro'])
        ->name('idosas.pdf.cadastro');

    Route::get('/idosas/{idosa}/pdf/plano', [PdfIdosaController::class, 'plano'])
        ->name('idosas.pdf.plano');

    Route::get('/idosas/{idosa}/pdf/termo', [PdfIdosaController::class, 'termo'])
        ->name('idosas.pdf.termo');

    Route::get('/idosas/{idosa}/pdf/completo', [PdfIdosaController::class, 'completo'])
        ->name('idosas.pdf.completo');

  
    Route::resource('voluntarios', VoluntarioController::class)->only(['store', 'update', 'destroy']);

    Route::resource('doadores', DoadorController::class)->only(['store', 'update', 'destroy']);
    Route::resource('doacoes', DoacaoController::class)->only(['update', 'destroy']);

    Route::post('/doadores/{doador}/doacoes', [DoacaoController::class, 'store'])
        ->name('doacoes.store');

    Route::get('/register-user', [RegisterUserController::class, 'create'])->name('register.user');
    Route::post('/register-user', [RegisterUserController::class, 'store'])->name('register.user.store');

    Route::get('/settings', [UserSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [UserSettingsController::class, 'update'])->name('settings.update');
});

Route::get('/alterar-senha', function () {
    return view('pages.auth.alterar-senha');
})->middleware('auth')->name('password.change');

Route::post('/alterar-senha', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    $user = auth()->user();

    $user->update([
        'password' => bcrypt($request->password)
    ]);

    return back()->with('success', 'Senha alterada com sucesso!');
})->middleware('auth');
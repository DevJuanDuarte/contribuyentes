<?php

use App\Http\Controllers\ContribuyentesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login'); // Asegúrate de que el nombre de la vista sea correcto
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Protege las rutas de authors con el middleware de roles
    // Route::middleware(['auth'])->group(function () {
    //     Route::resource('contribuyentes', App\Http\Controllers\ContribuyentesController::class);
    //     Route::resource('usuarios', UserController::class);

    // });

    Route::resource('contribuyentes', ContribuyentesController::class);

    Route::resource('usuarios', UserController::class);


});

require __DIR__ . '/auth.php';

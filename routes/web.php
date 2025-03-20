<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/clear-welcome-session', function () {
    session()->forget('welcome_shown');
    return response()->json(['status' => 'success']);
});

// Ruta del dashboard con nombre
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard'); // <-- Aquí asignamos el nombre "dashboard"
use App\Http\Controllers\UsuarioController;

Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');


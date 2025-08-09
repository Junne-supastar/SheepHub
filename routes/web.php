<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\MembroController;

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::get('/register/leader', [RegisterController::class, 'indexLider'])->name('register.lider');
    Route::get('/register/user', [RegisterController::class, 'indexUser'])->name('register.usuario');
    Route::post('/register/user', [RegisterController::class, 'registerUser'])->name('register.usuario.store');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
});

Route::middleware('auth')->group(function() {
    Route::get('/dashboard/members', [MembroController::class, 'index'])->name('membro.index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

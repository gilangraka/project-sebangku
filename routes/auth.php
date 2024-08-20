<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Route Get
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::get('login-admin', [AuthenticatedSessionController::class, 'create_admin'])
        ->name('login-admin');

    // Route Post
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::post('login', LoginController::class)->name('login.store');

    Route::post('login-admin', LoginAdminController::class)->name('login-admin.store');
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');

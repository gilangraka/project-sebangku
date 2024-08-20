<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ProdukController;
use App\Models\RefProduk;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = RefProduk::where('status_id', 2)->get();
    return view('welcome', compact('products'));
});

Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::resource('produk', ProdukController::class)->only(['index', 'store', 'update', 'destroy', 'edit']);
    Route::resource('manage-user', ManageUserController::class)->only(['index', 'update']);
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';

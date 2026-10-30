<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Routes untuk Aplikasi POS Inventory
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    
    // Route Modul Transaksi Penjualan & Pembelian
    Route::resource('sales', SaleController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('purchases', PurchaseController::class)->only(['index', 'create', 'store']);

    // ==========================================
    // Tambahan Route Quick Store untuk Dashboard
    // ==========================================
    Route::post('/dashboard/quick-product', [ProductController::class, 'quickStore'])->name('products.quickStore');
});

require __DIR__.'/auth.php';
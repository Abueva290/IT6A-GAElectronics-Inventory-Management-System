<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ReportController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('suppliers',  SupplierController::class)->except(['show']);
    Route::resource('customers',  CustomerController::class)->except(['show']);
    Route::resource('products',   ProductController::class);
    Route::resource('inventory',  InventoryController::class);
    Route::resource('sales',      SaleController::class);
    Route::get('reports',         [ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';
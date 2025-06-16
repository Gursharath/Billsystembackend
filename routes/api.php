<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\API\DashboardApiController;

// Auth
Route::post('/register', [AuthController::class, 'register']); // Only use ONCE to create owner
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::get('/barcode/{code}', [ProductController::class, 'barcode']);
    Route::get('/products/count', [ProductController::class, 'count']);
    Route::get('/product/count', [ProductController::class, 'count']);
    Route::get('/product/total-quantity', [ProductController::class, 'totalQuantity']);


    // Stock
    Route::post('/stock/in', [StockController::class, 'stockIn']);
    Route::post('/stock/out', [StockController::class, 'stockOut']);
    Route::get('/stock/logs', [StockController::class, 'logs']);
    Route::get('/stock/logs/latest', [StockController::class, 'latestLogs']);

    // Invoices
    Route::get('/invoices', [InvoiceController::class, 'index']);
    Route::post('/invoices', [InvoiceController::class, 'store']);
    Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
    Route::get('/dashboard-stats', [DashboardApiController::class, 'getStats']);
});


Route::get('/dashboard-stats', [DashboardApiController::class, 'getStats']);

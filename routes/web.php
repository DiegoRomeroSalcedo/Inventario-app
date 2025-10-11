<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/brands/getJsonToIndex', [BrandsController::class, 'getJsonToIndex'])
    ->middleware(['auth', 'verified'])
    ->name('brands.getJsonToIndex');

Route::get('/products/getJsonToProducts', [ProductController::class, 'getJsonToProducts'])
    ->middleware(['auth', 'verified'])
    ->name('products.getJsonToProducts');

Route::get('/products/data/{id}', [ProductController::class, 'getDataProduct'])->middleware(['auth', 'verified']);
Route::get('/clients/data/{id}', [ClientsController::class, 'getDataClient'])->middleware(['auth', 'verified']);

Route::resource('brands', BrandsController::class)->middleware(['auth', 'verified'])->names('brands');
Route::resource('products', ProductController::class)->middleware(['auth', 'verified'])->names('products');
Route::resource('sales', SalesController::class)->middleware(['auth', 'verified'])->names('sales');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

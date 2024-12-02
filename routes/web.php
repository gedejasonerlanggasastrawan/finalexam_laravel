<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route untuk menampilkan daftar produk
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route untuk menampilkan formulir tambah produk
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route untuk menyimpan produk baru
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route untuk menampilkan detail produk berdasarkan ID
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
// Route untuk menampilkan formulir edit produk berdasarkan ID
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route untuk memperbarui produk berdasarkan ID
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
// Route untuk menghapus produk berdasarkan ID
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
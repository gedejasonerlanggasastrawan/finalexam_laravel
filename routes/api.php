<?php
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;

Route::get('/', function () {
return view('welcome');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// // Route untuk menampilkan daftar produk
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// // Route untuk menampilkan formulir tambah produk
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// // Route untuk menyimpan produk baru
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// // Route untuk menampilkan detail produk berdasarkan ID
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
// // Route untuk menampilkan formulir edit produk berdasarkan ID
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// // Route untuk memperbarui produk berdasarkan ID
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
// // Route untuk menghapus produk berdasarkan ID
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::resource('products', ProductController::class);

Route::post("/register", [UserController::class,"register"]);
Route::post("/login", [UserController::class,"login"]);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/brands', BrandController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/products', ProductController::class);
    Route::post('/logout', [UserController::class, 'logout']);

});
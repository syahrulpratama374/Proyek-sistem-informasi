<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| AREA PUBLIK (Bisa diakses tanpa perlu login)
|--------------------------------------------------------------------------
*/
Route::get('/', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'detail']);

Route::get('/keranjang', [KeranjangController::class, 'index']);
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah']);
// Rute untuk menambah/mengurangi dan menghapus item
Route::post('/keranjang/{id}/update', [KeranjangController::class, 'update']);
Route::get('/keranjang/{id}/hapus', [KeranjangController::class, 'hapus']);

// Autentikasi (Login & Register)
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', function () { return view('auth.register'); });
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| AREA PELANGGAN (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout/proses', [CheckoutController::class, 'proses']);
    Route::get('/checkout/sukses', [CheckoutController::class, 'sukses']);
});


/*
|--------------------------------------------------------------------------
| AREA ADMIN (Wajib Login & Role = Admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); });

    // --- FITUR BARU: POS KASIR (OFFLINE) ---
    Route::get('/pos', [AdminPesananController::class, 'pos']);
    Route::post('/pos/simpan', [AdminPesananController::class, 'simpanPos']);

    Route::get('/pesanan', [AdminPesananController::class, 'index']);
    Route::get('/pesanan/{id}', [AdminPesananController::class, 'detail']);
    Route::post('/pesanan/{id}/status', [AdminPesananController::class, 'updateStatus']);

    Route::get('/produk', [AdminProdukController::class, 'index']);
    Route::get('/produk/tambah', [AdminProdukController::class, 'create']);
    Route::post('/produk', [AdminProdukController::class, 'store']);
    Route::get('/produk/{id}/edit', [AdminProdukController::class, 'edit']);
    Route::post('/produk/{id}', [AdminProdukController::class, 'update']);
    Route::post('/produk/{id}/hapus', [AdminProdukController::class, 'destroy']);

    Route::get('/laporan', [LaporanController::class, 'index']);
});
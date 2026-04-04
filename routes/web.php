<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CekRoleAdmin;
use App\Http\Controllers\LaporanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// A. SISI PELANGGAN (FRONT-END)
// ==========================================

// Halaman Awal
Route::get('/', [MenuController::class, 'index']);

// Halaman Autentikasi
Route::get('/login', function () { return view('auth.login'); });
Route::post('/login/proses', [AuthController::class, 'login']);

Route::get('/register', function () { return view('auth.register'); });
Route::post('/register/proses', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

// Halaman Detail Menu
Route::get('/menu/{id}', [MenuController::class, 'detail']);

// Halaman Keranjang
Route::get('/keranjang', [KeranjangController::class, 'index']);
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah']);

// Halaman Cek Out & Proses Pesanan
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout/proses', [CheckoutController::class, 'proses']);
Route::get('/checkout/sukses', [CheckoutController::class, 'sukses']);


// ==========================================
// B. SISI ADMIN (BACK-END)
// ==========================================
// INI BAGIAN YANG DITAMBAHKAN MIDDLEWARE SATPAM:

Route::middleware([CekRoleAdmin::class])->prefix('admin')->group(function () {
    
    // Halaman Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    });

    // Halaman Manajemen Produk / Menu
    Route::get('/produk', [AdminProdukController::class, 'index']); 
    Route::get('/produk/tambah', [AdminProdukController::class, 'create']);
    Route::post('/produk/simpan', [AdminProdukController::class, 'store']);
    Route::get('/produk/edit/{id}', [AdminProdukController::class, 'edit']);
    Route::post('/produk/update/{id}', [AdminProdukController::class, 'update']);
    Route::get('/produk/hapus/{id}', [AdminProdukController::class, 'destroy']);

    // Halaman Kelola Pesanan & Kasir
    Route::get('/pesanan', [AdminPesananController::class, 'index']); 
    Route::post('/pesanan/update/{id}', [AdminPesananController::class, 'updateStatus']);
    Route::get('/pesanan/detail/{id}', [AdminPesananController::class, 'detail']);

   
    // Halaman Laporan
    Route::get('/laporan', [LaporanController::class, 'index']);

});
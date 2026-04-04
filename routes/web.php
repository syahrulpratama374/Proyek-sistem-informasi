<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminProdukController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// A. SISI PELANGGAN (FRONT-END)
// ==========================================

// 1. Halaman Awal (Sekarang ditangani oleh Controller agar mengambil data Database)
Route::get('/', [MenuController::class, 'index']);

// Halaman Autentikasi
Route::get('/login', function () {
    return view('auth.login'); 
});
// Route::post('/login', [AuthController::class, 'login']); 

Route::get('/register', function () {
    return view('auth.register'); 
});

// Halaman Menu & Keranjang
Route::get('/menu/detail', function () {
    return view('menu.detail'); 
});

Route::get('/keranjang', function () {
    return view('keranjang.index');
});

// Halaman Cek Out
Route::get('/checkout', function () {
    return view('checkout.index');
});


// ==========================================
// B. SISI ADMIN (BACK-END)
// ==========================================
// Semua rute di dalam grup ini otomatis diawali dengan '/admin'

Route::prefix('admin')->group(function () {
    
    // Halaman Dashboard Admin -> (URL: /admin/dashboard)
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    });
    
    // Halaman Manajemen Produk / Menu -> (URL: /admin/produk)
    Route::get('/produk', [AdminProdukController::class, 'index']);

    // Halaman Kelola Pesanan & Kasir -> (URL: /admin/pesanan)
    Route::get('/pesanan', function () {
        return view('admin.pesanan.index'); 
    });

    // Halaman Laporan Penjualan -> (URL: /admin/laporan)
    Route::get('/laporan', function () {
        return view('admin.laporan.index'); 
    });

});
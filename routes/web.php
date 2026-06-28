<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RiwayatController;

// Import Middleware Satpam Kita
use App\Http\Middleware\CekRoleAdmin;
use App\Http\Middleware\CekRoleKasir;

/*
|--------------------------------------------------------------------------
| AREA PUBLIK (Bisa diakses tanpa perlu login)
|--------------------------------------------------------------------------
*/
Route::get('/', [MenuController::class, 'index'])->name('beranda');
Route::get('/menu/{id}', [MenuController::class, 'detail'])->name('menu.detail');

Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
Route::post('/keranjang/{id}/update', [KeranjangController::class, 'update'])->name('keranjang.update');
Route::get('/keranjang/{id}/hapus', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

// Autentikasi (Login & Register)
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/register', function () { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.proses');

/*
|--------------------------------------------------------------------------
| AREA PELANGGAN (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/proses', [CheckoutController::class, 'proses'])->name('checkout.proses');
    Route::get('/checkout/sukses', [CheckoutController::class, 'sukses'])->name('checkout.sukses');
});

/*
|--------------------------------------------------------------------------
| AREA INTERNAL (ADMIN & KASIR)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('auth')->group(function () {

// Jalur radar menggunakan perhitungan Total Pesanan
    Route::get('/cek-pesanan-baru', function (\Illuminate\Http\Request $request) {
        // Ambil ingatan jumlah pesanan terakhir dari kasir
        $lastCount = (int) $request->query('last_count', 0);
        
        // Hitung ada berapa total pesanan di database saat ini
        $currentCount = \App\Models\Pesanan::count();

        // Jika jumlah di database lebih banyak dari ingatan kasir
        if ($currentCount > $lastCount) {
            return response()->json([
                'ada_baru' => true, 
                'current_count' => $currentCount
            ]);
        }

        return response()->json([
            'ada_baru' => false, 
            'current_count' => $currentCount
        ]);
    })->name('admin.cekpesanan');

    // 🌟 DASHBOARD SEKARANG BISA DIAKSES ADMIN & KASIR 🌟
    Route::get('/dashboard', function () { 
        $hari_ini = \Carbon\Carbon::today();
        
        // Menghitung data asli dari Database
        $pesanan_hari_ini = \App\Models\Pesanan::whereDate('created_at', $hari_ini)->count();
        $perlu_diproses = \App\Models\Pesanan::whereIn('status', ['pending', 'diproses'])->count();
        // Menghitung semua orang yang bukan admin dan bukan kasir
        $total_pelanggan = \App\Models\User::whereNotIn('role', ['admin', 'kasir'])
                                     ->orWhereNull('role')
                                     ->count(); 
        $menu_aktif = \App\Models\Menu::where('tersedia', true)->count();

        return view('admin.dashboard', compact('pesanan_hari_ini', 'perlu_diproses', 'total_pelanggan', 'menu_aktif')); 
    })->name('admin.dashboard');

    // --- ZONA KHUSUS ADMIN (Pemilik Restoran) ---
    Route::middleware(CekRoleAdmin::class)->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('admin.laporan.cetak');
    });

    // --- ZONA KHUSUS KASIR (Staf Operasional) ---
    Route::middleware(CekRoleKasir::class)->group(function () {
        Route::get('/pos', [AdminPesananController::class, 'pos'])->name('kasir.pos');
        Route::post('/pos/simpan', [AdminPesananController::class, 'simpanPos'])->name('kasir.pos.simpan');
        
        Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('kasir.pesanan');
        Route::get('/pesanan/{id}', [AdminPesananController::class, 'detail'])->name('kasir.pesanan.detail');
        Route::post('/pesanan/{id}/status', [AdminPesananController::class, 'updateStatus'])->name('kasir.pesanan.status');

        Route::get('/produk', [AdminProdukController::class, 'index'])->name('kasir.produk');
        Route::get('/produk/tambah', [AdminProdukController::class, 'create'])->name('kasir.produk.tambah');
        Route::post('/produk', [AdminProdukController::class, 'store'])->name('kasir.produk.simpan');
        Route::get('/produk/{id}/edit', [AdminProdukController::class, 'edit'])->name('kasir.produk.edit');
        Route::post('/produk/{id}', [AdminProdukController::class, 'update'])->name('kasir.produk.update');
        Route::post('/produk/{id}/hapus', [AdminProdukController::class, 'destroy'])->name('kasir.produk.hapus');

        Route::get('/pesanan/{id}/struk', [AdminPesananController::class, 'cetakStruk'])->name('kasir.pesanan.struk');
    });

});
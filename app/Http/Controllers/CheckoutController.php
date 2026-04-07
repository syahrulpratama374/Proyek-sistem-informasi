<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth; // Pastikan ini ada

class CheckoutController extends Controller
{
    public function index()
    {
        // CEGAT JIKA BELUM LOGIN (Menggunakan Auth::check())
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk checkout.');
        }

        $keranjang = session('keranjang', []);
        return view('checkout.index', compact('keranjang'));
    }

    public function proses(Request $request) 
    {
        // CEGAT JIKA BELUM LOGIN (Menggunakan Auth::check())
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk checkout.');
        }

        // 1. Validasi input dari form checkout
        $request->validate([
            'nomor_meja' => ['required', 'string'],
            'metode_pembayaran' => ['required', 'in:tunai,transfer,qris'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ]);

        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        // Gunakan DB Transaction agar jika ada yang gagal, semuanya dibatalkan
        return DB::transaction(function () use ($request, $keranjang) {
            
            // Hitung total harga keranjang
            $total = collect($keranjang)->sum(fn($item) => $item['harga'] * $item['qty']);

            // 2. Buat data Pesanan Induk
            $pesanan = Pesanan::create([
                'user_id'           => Auth::id(), // Menggunakan Auth::id()
                'kode_pesanan'      => 'PSN-' . strtoupper(Str::random(8)),
                'nomor_meja'        => $request->nomor_meja,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_harga'       => $total,
                'catatan'           => $request->catatan,
                'status'            => 'pending',
            ]);

            // 3. Masukkan setiap item di keranjang ke Detail Pesanan
            foreach ($keranjang as $menuId => $item) {
                $pesanan->detailPesanans()->create([
                    'menu_id'      => $menuId,
                    'qty'          => $item['qty'],
                    'harga_satuan' => $item['harga'],
                ]);
            }

            // 4. Kosongkan keranjang setelah berhasil masuk database
            session()->forget('keranjang');
            
            // Arahkan ke halaman sukses
            return redirect('/checkout/sukses')->with('success', 'Pesanan berhasil dibuat!');
        });
    }

    // Menampilkan halaman sukses setelah checkout
    public function sukses()
    {
        return view('checkout.sukses');
    }
}
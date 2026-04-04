<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Menampilkan halaman form cek out
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        
        // Jika keranjang kosong, paksa kembali ke halaman keranjang
        if(empty($keranjang)) {
            return redirect('/keranjang');
        }

        // Hitung total belanja
        $total_belanja = 0;
        foreach($keranjang as $item) {
            $total_belanja += $item['harga'] * $item['jumlah'];
        }

        return view('checkout.index', compact('keranjang', 'total_belanja'));
    }

    // Memproses data form dan menyimpannya ke database
    public function proses(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        if(empty($keranjang)) { return redirect('/keranjang'); }

        $total_belanja = 0;
        foreach($keranjang as $item) {
            $total_belanja += $item['harga'] * $item['jumlah'];
        }

        // 1. Simpan data pelanggan ke tabel 'pesanans'
        $pesanan = Pesanan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $total_belanja,
            'status' => 'Menunggu Pembayaran'
        ]);

        // 2. Simpan rincian menu ke tabel 'detail_pesanans'
        foreach($keranjang as $id => $item) {
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'menu_id' => $id,
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga']
            ]);
        }

        // 3. Hapus keranjang dari session karena sudah dibayar/dipesan
        session()->forget('keranjang');

        // 4. Arahkan ke halaman sukses dengan membawa ID Pesanan
        return redirect('/checkout/sukses')->with('pesanan_id', $pesanan->id);
    }

    // Menampilkan halaman sukses
    public function sukses()
    {
        return view('checkout.sukses');
    }
}
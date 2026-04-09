<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPesananController extends Controller
{
   
    public function index()
    {
        $pesanans = Pesanan::orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

   
    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->update([
            'status' => $request->status
        ]);

        return redirect('/admin/pesanan')->with('success', 'Status pesanan berhasil diperbarui menjadi: ' . strtoupper($request->status));
    }
 
    public function detail($id)
    {
        
        $pesanan = Pesanan::with('detailPesanans.menu')->find($id);
        
        return view('admin.pesanan.detail', compact('pesanan'));
    }
    // Menampilkan halaman POS Kasir
    public function pos()
    {
        // Ambil semua menu yang sedang tersedia
        $menus = \App\Models\Menu::where('tersedia', true)->get();
        return view('admin.pos.index', compact('menus'));
    }

    // Memproses pesanan dari kasir ke database
    public function simpanPos(Request $request)
    {
        // Cek jika keranjang kosong
        if (!$request->has('menu_id')) {
            return back()->with('error', 'Pilih menu terlebih dahulu!');
        }

        // 1. Buat Data Pesanan Induk
        $pesanan = \App\Models\Pesanan::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(), // Mencatat Kasir/Admin yang melayani
            'kode_pesanan' => 'POS-' . time(), // Kode unik untuk offline
            'nomor_meja' => $request->nomor_meja ?? 'Bungkus/Takeaway',
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'selesai', // Anggap pesanan offline langsung dibayar dan selesai
            'total_harga' => $request->total_harga,
            'catatan' => 'Pelanggan Offline: ' . $request->nama_pelanggan // Menyimpan nama pelanggan manual
        ]);

        // 2. Simpan Rincian Menunya
        foreach ($request->menu_id as $key => $id) {
            \App\Models\DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'menu_id' => $id,
                'qty' => $request->qty[$key],
                'harga_satuan' => $request->harga_satuan[$key]
            ]);
        }

        // 3. Kembali ke halaman daftar pesanan dengan notifikasi
        return redirect('/admin/pesanan')->with('success', 'Pesanan Offline a.n ' . $request->nama_pelanggan . ' berhasil diproses!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPesananController extends Controller
{
    // 1. Menampilkan daftar semua pesanan (Untuk index.blade.php)
    public function index()
    {
        // Mengambil pesanan diurutkan dari yang terbaru
        $pesanans = Pesanan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    // 2. Menampilkan detail pesanan (Untuk detail.blade.php)
    public function detail($id)
    {
        // Mengambil pesanan beserta data relasinya (user dan daftar menu yang dipesan)
        $pesanan = Pesanan::with(['user', 'detailPesanans.menu'])->findOrFail($id);
        return view('admin.pesanan.detail', compact('pesanan'));
    }

    // 3. FUNGSI BARU: Memproses perubahan status dari Form
    public function updateStatus(Request $request, $id)
    {
        // Validasi agar status yang dikirim tidak sembarangan
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,batal'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        
        // Simpan status lama untuk mengecek apakah ini pembatalan
        $statusLama = $pesanan->status;

        DB::transaction(function () use ($request, $pesanan, $statusLama) {
            
            // Update status pesanan ke yang baru
            $pesanan->update([
                'status' => $request->status
            ]);

            // LOGIKA BISNIS SENIOR: Jika dibatalkan, kembalikan stok makanan!
            if ($request->status == 'batal' && $statusLama != 'batal') {
                foreach ($pesanan->detailPesanans as $detail) {
                    if ($detail->menu) {
                        $detail->menu->increment('stok', $detail->qty);
                    }
                }
            }
            
            // Opsional: Jika dari batal diubah lagi jadi diproses, kurangi stok lagi
            if ($statusLama == 'batal' && $request->status != 'batal') {
                 foreach ($pesanan->detailPesanans as $detail) {
                    if ($detail->menu) {
                        $detail->menu->decrement('stok', $detail->qty);
                    }
                }
            }

        });

        // Kembalikan admin ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Status pesanan #' . $pesanan->kode_pesanan . ' berhasil diubah menjadi ' . strtoupper($request->status) . '!');
    }
}
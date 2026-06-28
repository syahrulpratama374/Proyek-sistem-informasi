<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tanggal dari input, jika kosong default ke bulan ini
        $tgl_mulai = $request->get('tgl_mulai', Carbon::now()->startOfMonth()->toDateString());
        $tgl_selesai = $request->get('tgl_selesai', Carbon::now()->toDateString());

        // Query pesanan yang sukses/selesai pada rentang tanggal tersebut
        $laporan = Pesanan::with('user')
            ->where('status', 'selesai')
            ->whereDate('created_at', '>=', $tgl_mulai)
            ->whereDate('created_at', '<=', $tgl_selesai)
            ->orderBy('created_at', 'desc')
            ->get();

        $total_pendapatan = $laporan->sum('total_harga');

        return view('admin.laporan.index', compact('laporan', 'total_pendapatan', 'tgl_mulai', 'tgl_selesai'));
    }

    public function cetak(Request $request)
    {
        $tgl_mulai = $request->get('tgl_mulai');
        $tgl_selesai = $request->get('tgl_selesai');

        $laporan = Pesanan::with(['user', 'detailPesanans.menu'])
            ->where('status', 'selesai')
            ->whereDate('created_at', '>=', $tgl_mulai)
            ->whereDate('created_at', '<=', $tgl_selesai)
            ->get();

        $total_pendapatan = $laporan->sum('total_harga');

        return view('admin.laporan.cetak', compact('laporan', 'total_pendapatan', 'tgl_mulai', 'tgl_selesai'));
    }
}
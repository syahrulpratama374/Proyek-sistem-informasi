<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LaporanController extends Controller
{
    public function index(Request $request) {
        
        $tanggal = $request->input('tanggal', today()->toDateString());

        $laporan = Cache::remember(
            "laporan_{$tanggal}", 300, // cache 5 menit
            function () use ($tanggal) {
                return Pesanan::with(['detailPesanans.menu', 'user'])
                    ->whereDate('created_at', $tanggal)
                    ->where('status', 'selesai')
                    ->get();
            }
        );

        $totalPendapatan = $laporan->sum('total_harga');
        $totalPesanan    = $laporan->count();

        return view('admin.laporan.index', compact(
            'laporan', 'totalPendapatan', 'totalPesanan', 'tanggal'
        ));
    }
}
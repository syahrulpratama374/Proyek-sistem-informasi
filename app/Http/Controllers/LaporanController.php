<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon; // Wajib dipanggil untuk manipulasi waktu

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tangkap filter dari URL (default: 'semua')
        $filter = $request->query('filter', 'semua');
        
        // 2. Siapkan query dasar: HANYA AMBIL PESANAN YANG SELESAI
        $query = Pesanan::with('user')->where('status', 'selesai');

        $now = Carbon::now();

        // 3. Terapkan filter tanggal
        switch ($filter) {
            case 'hari':
                $query->whereDate('created_at', $now->today());
                break;
            case 'minggu':
                $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
                break;
            case 'bulan':
                $query->whereMonth('created_at', $now->month)
                      ->whereYear('created_at', $now->year);
                break;
            case 'tahun':
                $query->whereYear('created_at', $now->year);
                break;
            // Jika 'semua', biarkan query berjalan tanpa batasan tanggal
        }

        // 4. Eksekusi query (urutkan dari yang terbaru)
        $laporans = $query->orderBy('created_at', 'desc')->get();

        // 5. Hitung total pendapatan dari hasil filter tersebut
        $totalPendapatan = $laporans->sum('total_harga');

        return view('admin.laporan.index', compact('laporans', 'totalPendapatan', 'filter'));
    }
}
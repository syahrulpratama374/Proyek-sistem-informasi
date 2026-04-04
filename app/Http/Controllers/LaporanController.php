<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Ambil HANYA pesanan yang statusnya sudah 'Selesai'
        $pesanans = Pesanan::where('status', 'Selesai')->orderBy('created_at', 'desc')->get();

        // 2. Hitung total pendapatan dari semua pesanan yang selesai
        $total_pendapatan = $pesanans->sum('total_harga');

        // 3. Kirim datanya ke halaman laporan
        return view('admin.laporan.index', compact('pesanans', 'total_pendapatan'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        // Ambil pesanan HANYA milik user yang sedang login
        // Gunakan with('detailPesanans.menu') agar query lebih optimal (Eager Loading)
        $pesanans = Pesanan::with('detailPesanans.menu')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('riwayat.index', compact('pesanans'));
    }
}
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
}
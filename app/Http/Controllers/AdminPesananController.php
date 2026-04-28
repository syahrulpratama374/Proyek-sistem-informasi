<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPesananController extends Controller
{
   
    public function index()
    {
        
        $pesanans = Pesanan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    
    public function detail($id)
    {
        
        $pesanan = Pesanan::with(['user', 'detailPesanans.menu'])->findOrFail($id);
        return view('admin.pesanan.detail', compact('pesanan'));
    }

   
    public function updateStatus(Request $request, $id)
    {
       
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,batal'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        
        
        $statusLama = $pesanan->status;

        DB::transaction(function () use ($request, $pesanan, $statusLama) {
            
            
            $pesanan->update([
                'status' => $request->status
            ]);

           
            if ($request->status == 'batal' && $statusLama != 'batal') {
                foreach ($pesanan->detailPesanans as $detail) {
                    if ($detail->menu) {
                        $detail->menu->increment('stok', $detail->qty);
                    }
                }
            }
            
            
            if ($statusLama == 'batal' && $request->status != 'batal') {
                 foreach ($pesanan->detailPesanans as $detail) {
                    if ($detail->menu) {
                        $detail->menu->decrement('stok', $detail->qty);
                    }
                }
            }

        });

        
        return back()->with('success', 'Status pesanan #' . $pesanan->kode_pesanan . ' berhasil diubah menjadi ' . strtoupper($request->status) . '!');
    }

    
    public function pos()
    {
        
        $menus = Menu::where('tersedia', true)->get();
        
        
        return view('admin.pos.index', compact('menus'));
    }
}
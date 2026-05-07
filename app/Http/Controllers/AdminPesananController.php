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
            'status' => 'required|in:pending,diproses,diantar,selesai,batal'
        ]);

        $pesanan = Pesanan::findOrFail($id);
        
        // $statusLama = $pesanan->status;

        DB::transaction(function () use ($request, $pesanan) {
            
            // Hanya mengubah status pesanan
            $pesanan->update([
                'status' => $request->status
            ]);

            // FITUR STOK DIMATIKAN KARENA KOLOM 'STOK' TIDAK ADA DI DATABASE
            /*
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
            */

        });

        return back()->with('success', 'Status pesanan #' . $pesanan->kode_pesanan . ' berhasil diubah menjadi ' . strtoupper($request->status) . '!');
    }

    public function pos()
    {
        $menus = Menu::where('tersedia', true)->get();
        return view('admin.pos.index', compact('menus'));
    }

    public function cetakStruk($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanans.menu'])->findOrFail($id);
        return view('admin.pesanan.struk', compact('pesanan'));
    }

    public function simpanPos(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'total_harga' => 'required|numeric|min:1',
            'menu_id' => 'required|array',
            'qty' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {
            
            $pesanan = Pesanan::create([
                'kode_pesanan' => 'POS-' . strtoupper(substr(uniqid(), -6)), 
                'user_id' => auth()->id(), 
                'nomor_meja' => $request->nomor_meja ? "Meja " . $request->nomor_meja . " (" . $request->nama_pelanggan . ")" : "Takeaway (" . $request->nama_pelanggan . ")",
                'status' => 'selesai', 
                'metode_pembayaran' => $request->metode_pembayaran,
                'total_harga' => $request->total_harga,
                'catatan' => 'Pesanan via Kasir Offline (POS)'
            ]);

            foreach ($request->menu_id as $key => $menuId) {
                \App\Models\DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $menuId,
                    'qty' => $request->qty[$key],
                    'harga_satuan' => $request->harga_satuan[$key]
                ]);

                // FITUR STOK DIMATIKAN SEMENTARA
                // \App\Models\Menu::where('id', $menuId)->decrement('stok', $request->qty[$key]);
            }
        });

        return redirect('/admin/pesanan')->with('success', 'Transaksi Kasir atas nama ' . $request->nama_pelanggan . ' berhasil diproses!');
    }
}
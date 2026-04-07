<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('keranjang.index', compact('keranjang'));
    }

    // Memasukkan menu dari halaman depan/detail ke keranjang
    public function tambah(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);
        $keranjang = session()->get('keranjang', []);

        if(isset($keranjang[$request->menu_id])) {
            $keranjang[$request->menu_id]['qty'] += $request->qty;
        } else {
            $keranjang[$request->menu_id] = [
                "nama_menu" => $menu->nama_menu,
                "qty" => $request->qty,
                "harga" => $menu->harga,
                "foto" => $menu->foto // Menyimpan foto agar bisa ditampilkan di keranjang
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect('/keranjang');
    }

    // FUNGSI BARU: Mengatur tombol Plus (+) dan Minus (-)
    public function update(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);

        // Pastikan menu ada di dalam keranjang
        if (isset($keranjang[$id])) {
            if ($request->action == 'tambah') {
                $keranjang[$id]['qty']++;
            } elseif ($request->action == 'kurang') {
                if ($keranjang[$id]['qty'] > 1) {
                    $keranjang[$id]['qty']--;
                } else {
                    // Jika porsi tersisa 1 lalu dikurangi, menu otomatis dihapus
                    unset($keranjang[$id]);
                }
            }
            // Simpan kembali ke memori
            session()->put('keranjang', $keranjang);
        }

        return back();
    }

    // FUNGSI BARU: Menghapus menu dari keranjang secara langsung
    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);
        
        if(isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        
        return back();
    }
}
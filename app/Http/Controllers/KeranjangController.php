<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Fungsi untuk menampilkan halaman keranjang
    public function index()
    {
        // Ambil data keranjang dari memori sementara (session)
        $keranjang = session()->get('keranjang', []);
        return view('keranjang.index', compact('keranjang'));
    }

    public function tambah(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);
        $keranjang = session()->get('keranjang', []);

        if(isset($keranjang[$request->menu_id])) {
            $keranjang[$request->menu_id]['qty'] += $request->qty; // Ubah jumlah jadi qty
        } else {
            $keranjang[$request->menu_id] = [
                "nama_menu" => $menu->nama_menu,
                "qty" => $request->qty, // Ubah jumlah jadi qty
                "harga" => $menu->harga
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect('/keranjang');
    }
}
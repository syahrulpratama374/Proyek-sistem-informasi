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

    // Fungsi untuk memasukkan menu ke keranjang
    public function tambah(Request $request)
    {
        $menu = Menu::find($request->menu_id);
        $keranjang = session()->get('keranjang', []);

        // Jika menu sudah ada di keranjang, cukup tambahkan jumlah porsinya
        if(isset($keranjang[$request->menu_id])) {
            $keranjang[$request->menu_id]['jumlah'] += $request->jumlah;
        } else {
            // Jika belum ada, buat data baru di keranjang
            $keranjang[$request->menu_id] = [
                "nama_menu" => $menu->nama_menu,
                "jumlah" => $request->jumlah,
                "harga" => $menu->harga
            ];
        }

        // Simpan kembali ke session
        session()->put('keranjang', $keranjang);

        // Arahkan pelanggan ke halaman keranjang
        return redirect('/keranjang');
    }
}
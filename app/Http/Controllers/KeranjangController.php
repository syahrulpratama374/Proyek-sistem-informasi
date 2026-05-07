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
                "foto" => $menu->foto 
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect('/keranjang');
    }

    // FUNGSI AJAX: Mengatur tombol Plus (+) dan Minus (-) tanpa Reload
    public function update(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            if ($request->action == 'tambah') {
                $keranjang[$id]['qty']++;
            } elseif ($request->action == 'kurang') {
                if ($keranjang[$id]['qty'] > 1) {
                    $keranjang[$id]['qty']--;
                } else {
                    unset($keranjang[$id]);
                }
            }
            session()->put('keranjang', $keranjang);
        }

        // 🌟 JIKA REQUEST DATANG DARI AJAX, BALAS DENGAN DATA JSON 🌟
        if ($request->ajax()) {
            $total_belanja = 0;
            $total_item = 0;
            
            foreach ($keranjang as $item) {
                $total_belanja += $item['harga'] * $item['qty'];
                $total_item += $item['qty'];
            }

            return response()->json([
                'success' => true,
                'is_empty' => count($keranjang) === 0,
                'unique_items' => count($keranjang),
                'total_item' => $total_item,
                'total_belanja' => number_format($total_belanja, 0, ',', '.'),
                'item_qty' => isset($keranjang[$id]) ? $keranjang[$id]['qty'] : 0,
                'item_subtotal' => isset($keranjang[$id]) ? number_format($keranjang[$id]['harga'] * $keranjang[$id]['qty'], 0, ',', '.') : 0,
            ]);
        }

        return back();
    }

    // Menghapus menu dari keranjang secara langsung
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
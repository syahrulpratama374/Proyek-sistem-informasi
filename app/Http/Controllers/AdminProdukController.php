<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request; 

class AdminProdukController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('admin.produk.index', compact('menus'));
    }

    // Fungsi untuk menampilkan halaman form tambah menu
    public function create()
    {
        return view('admin.produk.create');
    }

    // Fungsi untuk menangkap data dari form dan menyimpannya ke database
    public function store(Request $request)
    {
        $path_foto = null;

        // Cek apakah admin mengunggah file foto
        if ($request->hasFile('foto')) {
            // Simpan foto ke dalam folder: storage/app/public/menu_foto
            // 'public' di sini artinya menggunakan disk public yang tadi kita link
            $path_foto = $request->file('foto')->store('menu_foto', 'public');
        }

        // Proses simpan data ke tabel menus
        Menu::create([
            'nama_menu' => $request->nama_menu,
            'kategori'  => $request->kategori,
            'harga'     => $request->harga,
            'deskripsi' => $request->deskripsi,
            'foto'      => $path_foto, // Masukkan path foto ke database
        ]);

        return redirect('/admin/produk');
    }
    // Menampilkan form edit dengan data menu yang dipilih
    public function edit($id)
    {
        $menu = Menu::find($id); // Mencari menu berdasarkan ID
        return view('admin.produk.edit', compact('menu'));
    }

    // Memproses data yang diubah dari form edit
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->update([
            'nama_menu' => $request->nama_menu,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/admin/produk');
    }

    // Menghapus data menu
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        return redirect('/admin/produk');
    }
}
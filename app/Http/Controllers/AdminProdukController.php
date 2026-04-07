<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;

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
    // Fungsi untuk menangkap data dari form TAMBAH MENU dan menyimpannya ke database
    public function store(Request $request)
    {
        $dataSimpan = [
            'nama_menu' => $request->nama_menu,
            'kategori'  => $request->kategori,
            'harga'     => $request->harga,
            'deskripsi' => $request->deskripsi,
            'tersedia'  => $request->has('tersedia'), // Checkbox ketersediaan
        ];

        // Cek apakah admin mengupload foto
        if ($request->hasFile('foto')) {
            $dataSimpan['foto'] = $request->file('foto')->store('menu_foto', 'public');
        }

        Menu::create($dataSimpan);

        return redirect('/admin/produk')->with('success', 'Menu berhasil ditambahkan!');
    }

    // Fungsi untuk menangkap data dari form dan menyimpannya ke database
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        
        // Data default yang diupdate
        $dataUpdate = [
            'nama_menu' => $request->nama_menu,
            'kategori'  => $request->kategori,
            'harga'     => $request->harga,
            'deskripsi' => $request->deskripsi,
            'tersedia'  => $request->has('tersedia'), // Checkbox ketersediaan
        ];

        // Cek apakah admin mengupload foto baru saat edit
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($menu->foto) {
                Storage::disk('public')->delete($menu->foto);
            }
            // Simpan foto baru
            $dataUpdate['foto'] = $request->file('foto')->store('menu_foto', 'public');
        }

        $menu->update($dataUpdate);

        return redirect('/admin/produk');
    }
    // Menampilkan form edit dengan data menu yang dipilih
    public function edit($id)
    {
        $menu = Menu::find($id); // Mencari menu berdasarkan ID
        return view('admin.produk.edit', compact('menu'));
    }

    // Menghapus data menu
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        return redirect('/admin/produk');
    }
}
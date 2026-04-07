<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
     
        $query = Menu::where('tersedia', true);

        if ($request->has('cari') && $request->cari != '') {
            $query->where('nama_menu', 'like', '%' . $request->cari . '%');
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $menus = $query->get();
        return view('awal', compact('menus'));
    }

    public function detail($id)
    {
        $menu = Menu::findOrFail($id); 
        
        return view('menu.detail', compact('menu'));
    }
}
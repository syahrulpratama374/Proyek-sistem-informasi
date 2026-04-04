<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('awal', compact('menus'));
    }

    // --- TAMBAHKAN FUNGSI INI ---
    public function detail($id)
    {
        // Cari data menu berdasarkan ID
        $menu = Menu::find($id); 
        
        // Tampilkan halaman detail dengan membawa data menu tersebut
        return view('menu.detail', compact('menu'));
    }
}
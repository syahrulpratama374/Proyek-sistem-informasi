<?php

namespace App\Http\Controllers;

use App\Models\Menu; // Import model Menu
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Mengambil semua data menu dari database
        $menus = Menu::all();

        // Mengirim data $menus ke view 'awal'
        return view('awal', compact('menus'));
    }
}
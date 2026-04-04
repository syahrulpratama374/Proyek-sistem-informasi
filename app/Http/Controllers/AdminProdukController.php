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
}
@extends('admin.layouts.app')

@section('title', 'Edit Menu')
@section('header_title', 'Edit Menu Salero Bundo')

@section('content')
<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 600px;">
    
    <form action="/admin/produk/update/{{ $menu->id }}" method="POST">
        @csrf 
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Menu</label>
            <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Kategori</label>
            <select name="kategori" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                <option value="Makanan" {{ $menu->kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="Minuman" {{ $menu->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                <option value="Lauk Pauk" {{ $menu->kategori == 'Lauk Pauk' ? 'selected' : '' }}>Lauk Pauk</option>
                <option value="Sayuran" {{ $menu->kategori == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Harga (Rp)</label>
            <input type="number" name="harga" value="{{ $menu->harga }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Deskripsi Menu</label>
            <textarea name="deskripsi" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">{{ $menu->deskripsi }}</textarea>
        </div>

        <button type="submit" style="padding: 10px 20px; background: orange; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Update Menu</button>
        <a href="/admin/produk" style="margin-left: 15px; color: #dc3545; text-decoration: none;">Batal</a>
    </form>
</div>
@endsection
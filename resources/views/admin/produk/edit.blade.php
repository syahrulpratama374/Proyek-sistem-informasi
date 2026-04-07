@extends('admin.layouts.app')

@section('title', 'Edit Menu')
@section('header_title', 'Edit Menu: ' . $menu->nama_menu)

@section('content')
<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 600px;">
    
    <form action="/admin/produk/{{ $menu->id }}" method="POST" enctype="multipart/form-data">
        @csrf 
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Menu <span style="color:red;">*</span></label>
            <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Kategori <span style="color:red;">*</span></label>
                <select name="kategori" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                    <option value="Lauk Utama" {{ $menu->kategori == 'Lauk Utama' ? 'selected' : '' }}>Lauk Utama</option>
                    <option value="Sayuran" {{ $menu->kategori == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                    <option value="Nasi & Karbohidrat" {{ $menu->kategori == 'Nasi & Karbohidrat' ? 'selected' : '' }}>Nasi & Karbohidrat</option>
                    <option value="Minuman" {{ $menu->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Harga (Rp) <span style="color:red;">*</span></label>
                <input type="number" name="harga" value="{{ $menu->harga }}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="margin-bottom: 15px; background: #f8f9fa; padding: 10px; border-radius: 4px; border: 1px solid #ddd;">
            <label style="display: flex; align-items: center; cursor: pointer; font-weight: bold;">
                <input type="checkbox" name="tersedia" {{ $menu->tersedia ? 'checked' : '' }} style="margin-right: 10px; transform: scale(1.2);">
                Menu Tersedia (Siap Dijual)
            </label>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Deskripsi Menu</label>
            <textarea name="deskripsi" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">{{ $menu->deskripsi }}</textarea>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Ganti Foto Menu (Opsional)</label>
            
            @if($menu->foto)
                <div style="margin-bottom: 10px;">
                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="Foto Lama" style="height: 60px; border-radius: 4px; border: 1px solid #ddd;">
                </div>
            @endif
            
            <input type="file" name="foto" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; background: #f8f9fa;">
            <small style="color: #666; display: block; margin-top: 5px;">Biarkan kosong jika tidak ingin mengubah foto.</small>
        </div>

        <button type="submit" style="padding: 10px 20px; background: #f39c12; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Update Menu</button>
        <a href="/admin/produk" style="margin-left: 15px; color: #dc3545; text-decoration: none; font-weight: bold;">Batal</a>
    </form>
</div>
@endsection
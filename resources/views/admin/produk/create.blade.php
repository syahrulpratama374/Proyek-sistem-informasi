@extends('admin.layouts.app')

@section('title', 'Tambah Menu Baru')
@section('header_title', 'Tambah Menu Salero Bundo')

@section('content')
<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 600px;">
    
    <form action="/admin/produk/simpan" method="POST" enctype="multipart/form-data">
        
        @csrf 
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Menu</label>
            <input type="text" name="nama_menu" required placeholder="Contoh: Ayam Bakar" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Kategori</label>
            <select name="kategori" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Lauk Pauk">Lauk Pauk</option>
                <option value="Sayuran">Sayuran</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Harga (Rp)</label>
            <input type="number" name="harga" required placeholder="Contoh: 15000" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Deskripsi Menu</label>
            <textarea name="deskripsi" rows="3" placeholder="Jelaskan menu ini secara singkat..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;"></textarea>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Foto Menu (Opsional)</label>
            <input type="file" name="foto" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; background: #f8f9fa;">
            <small style="color: #666; display: block; margin-top: 5px;">Format yang didukung: JPG, PNG, JPEG.</small>
        </div>

        <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Simpan Menu</button>
        <a href="/admin/produk" style="margin-left: 15px; color: #dc3545; text-decoration: none;">Batal</a>
    </form>
</div>
@endsection
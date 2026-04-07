@extends('admin.layouts.app')

@section('title', 'Tambah Menu Baru')
@section('header_title', 'Tambah Menu Salero Bundo')

@section('content')
<div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 600px;">
    
    <form action="/admin/produk" method="POST" enctype="multipart/form-data">
        @csrf 
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Menu <span style="color:red;">*</span></label>
            <input type="text" name="nama_menu" required placeholder="Contoh: Ayam Bakar" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Kategori <span style="color:red;">*</span></label>
                <select name="kategori" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                    <option value="Lauk Utama">Lauk Utama</option>
                    <option value="Sayuran">Sayuran</option>
                    <option value="Nasi & Karbohidrat">Nasi & Karbohidrat</option>
                    <option value="Minuman">Minuman</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Harga (Rp) <span style="color:red;">*</span></label>
                <input type="number" name="harga" required placeholder="15000" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
            </div>
        </div>

        <div style="margin-bottom: 15px; background: #f8f9fa; padding: 10px; border-radius: 4px; border: 1px solid #ddd;">
            <label style="display: flex; align-items: center; cursor: pointer; font-weight: bold;">
                <input type="checkbox" name="tersedia" checked style="margin-right: 10px; transform: scale(1.2);">
                Menu Tersedia (Siap Dijual)
            </label>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Deskripsi Menu</label>
            <textarea name="deskripsi" rows="3" placeholder="Jelaskan menu ini secara singkat..." style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;"></textarea>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Foto Menu (Opsional)</label>
            <input type="file" name="foto" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; background: #f8f9fa;">
            <small style="color: #666; display: block; margin-top: 5px;">Format: JPG, PNG, JPEG. Max 2MB.</small>
        </div>

        <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Simpan Menu</button>
        <a href="/admin/produk" style="margin-left: 15px; color: #dc3545; text-decoration: none; font-weight: bold;">Batal</a>
    </form>
</div>
@endsection
@extends('admin.layouts.app')

@section('title', 'Tambah Menu Baru')
@section('header_title', 'Racik Menu Baru')

@section('content')
<style>
    .rm-label { display: block; margin-bottom: 8px; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px; font-weight: bold; }
    .rm-input { width: 100%; padding: 12px 15px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(201, 168, 76, 0.3); border-radius: 4px; color: #FAF3E0; font-family: 'Nunito Sans', sans-serif; box-sizing: border-box; transition: 0.3s; }
    .rm-input:focus { outline: none; border-color: #C9A84C; background: rgba(201, 168, 76, 0.08); }
    .rm-input::placeholder { color: rgba(250, 243, 224, 0.3); }
    select.rm-input option { background: #0A0805; color: #FAF3E0; }
</style>

<div style="background: #0A0805; padding: 35px; border-radius: 8px; border: 1px solid rgba(201, 168, 76, 0.2); box-shadow: 0 4px 15px rgba(0,0,0,0.5); max-width: 650px;">
    
    <form action="/admin/produk" method="POST" enctype="multipart/form-data">
        @csrf 
        
        <div style="margin-bottom: 20px;">
            <label class="rm-label">Nama Menu <span style="color:#ff6b6b;">*</span></label>
            <input type="text" name="nama_menu" required placeholder="Contoh: Rendang Daging Asli" class="rm-input">
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label class="rm-label">Kategori <span style="color:#ff6b6b;">*</span></label>
                <select name="kategori" required class="rm-input">
                    <option value="Lauk Utama">Lauk Utama</option>
                    <option value="Sayuran">Sayuran</option>
                    <option value="Nasi & Karbohidrat">Nasi & Karbohidrat</option>
                    <option value="Minuman">Minuman</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label class="rm-label">Harga (Rp) <span style="color:#ff6b6b;">*</span></label>
                <input type="number" name="harga" required placeholder="Contoh: 25000" class="rm-input">
            </div>
        </div>

        <div style="margin-bottom: 20px; background: rgba(201, 168, 76, 0.05); padding: 15px; border-radius: 4px; border: 1px solid rgba(201, 168, 76, 0.2);">
            <label style="display: flex; align-items: center; cursor: pointer; color: #FAF3E0; font-family: 'Nunito Sans', sans-serif;">
                <input type="checkbox" name="tersedia" checked style="margin-right: 12px; transform: scale(1.3); accent-color: #C9A84C;">
                Tandai sebagai <b>Menu Tersedia (Siap Dijual)</b>
            </label>
        </div>

        <div style="margin-bottom: 20px;">
            <label class="rm-label">Deskripsi & Racikan Menu</label>
            <textarea name="deskripsi" rows="4" placeholder="Ceritakan keistimewaan rasa dari menu ini..." class="rm-input"></textarea>
        </div>

        <div style="margin-bottom: 30px;">
            <label class="rm-label">Foto Menu Premium (Opsional)</label>
            <input type="file" name="foto" accept="image/*" class="rm-input" style="padding: 9px 15px;">
            <small style="color: rgba(250, 243, 224, 0.4); display: block; margin-top: 8px; font-style: italic;">Format: JPG, PNG, JPEG. Ukuran Maksimal: 2MB.</small>
        </div>

        <div style="display: flex; align-items: center; gap: 20px;">
            <button type="submit" style="padding: 12px 28px; background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; border: none; border-radius: 4px; font-family: 'Cinzel', serif; font-weight: bold; letter-spacing: 1px; cursor: pointer; box-shadow: 0 4px 15px rgba(201,168,76,0.2); transition: 0.3s;">
                SIMPAN MENU
            </button>
            <a href="/admin/produk" style="color: #ff6b6b; text-decoration: none; font-family: 'Cinzel', serif; font-size: 12px; font-weight: bold; letter-spacing: 1px;">BATAL</a>
        </div>
    </form>
</div>
@endsection
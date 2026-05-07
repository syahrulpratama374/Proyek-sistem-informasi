@extends('admin.layouts.app')

@section('title', 'Edit Menu')
@section('header_title', 'Ubah Resep: ' . $menu->nama_menu)

@section('content')
<style>
    .rm-label { display: block; margin-bottom: 8px; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px; font-weight: bold; }
    .rm-input { width: 100%; padding: 12px 15px; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(201, 168, 76, 0.3); border-radius: 4px; color: #FAF3E0; font-family: 'Nunito Sans', sans-serif; box-sizing: border-box; transition: 0.3s; }
    .rm-input:focus { outline: none; border-color: #C9A84C; background: rgba(201, 168, 76, 0.08); }
    select.rm-input option { background: #0A0805; color: #FAF3E0; }
</style>

<div style="background: #0A0805; padding: 35px; border-radius: 8px; border: 1px solid rgba(201, 168, 76, 0.2); box-shadow: 0 4px 15px rgba(0,0,0,0.5); max-width: 650px;">
    
    <form action="/admin/produk/{{ $menu->id }}" method="POST" enctype="multipart/form-data">
        @csrf 
        
        <div style="margin-bottom: 20px;">
            <label class="rm-label">Nama Menu <span style="color:#ff6b6b;">*</span></label>
            <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" required class="rm-input">
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label class="rm-label">Kategori <span style="color:#ff6b6b;">*</span></label>
                <select name="kategori" required class="rm-input">
                    <option value="Lauk Utama" {{ $menu->kategori == 'Lauk Utama' ? 'selected' : '' }}>Lauk Utama</option>
                    <option value="Sayuran" {{ $menu->kategori == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                    <option value="Nasi & Karbohidrat" {{ $menu->kategori == 'Nasi & Karbohidrat' ? 'selected' : '' }}>Nasi & Karbohidrat</option>
                    <option value="Minuman" {{ $menu->kategori == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>
            <div style="flex: 1;">
                <label class="rm-label">Harga (Rp) <span style="color:#ff6b6b;">*</span></label>
                <input type="number" name="harga" value="{{ $menu->harga }}" required class="rm-input">
            </div>
        </div>

        <div style="margin-bottom: 20px; background: rgba(201, 168, 76, 0.05); padding: 15px; border-radius: 4px; border: 1px solid rgba(201, 168, 76, 0.2);">
            <label style="display: flex; align-items: center; cursor: pointer; color: #FAF3E0; font-family: 'Nunito Sans', sans-serif;">
                <input type="checkbox" name="tersedia" {{ $menu->tersedia ? 'checked' : '' }} style="margin-right: 12px; transform: scale(1.3); accent-color: #C9A84C;">
                Tandai sebagai <b>Menu Tersedia (Siap Dijual)</b>
            </label>
        </div>

        <div style="margin-bottom: 20px;">
            <label class="rm-label">Deskripsi & Racikan Menu</label>
            <textarea name="deskripsi" rows="4" class="rm-input">{{ $menu->deskripsi }}</textarea>
        </div>

        <div style="margin-bottom: 30px;">
            <label class="rm-label">Ganti Foto Menu (Opsional)</label>
            
            @if($menu->foto)
                <div style="margin-bottom: 12px; display: inline-block; padding: 5px; border: 1px solid rgba(201,168,76,0.3); border-radius: 4px; background: rgba(255,255,255,0.02);">
                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="Foto Lama" style="height: 80px; object-fit: cover; border-radius: 2px;">
                </div>
            @endif
            
            <input type="file" name="foto" accept="image/*" class="rm-input" style="padding: 9px 15px;">
            <small style="color: rgba(250, 243, 224, 0.4); display: block; margin-top: 8px; font-style: italic;">Biarkan kosong jika tidak ingin mengubah foto hidangan ini.</small>
        </div>

        <div style="display: flex; align-items: center; gap: 20px;">
            <button type="submit" style="padding: 12px 28px; background: transparent; border: 1px solid #C9A84C; color: #C9A84C; border-radius: 4px; font-family: 'Cinzel', serif; font-weight: bold; letter-spacing: 1px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='#C9A84C'; this.style.color='#0A0805';" onmouseout="this.style.background='transparent'; this.style.color='#C9A84C';">
                UPDATE MENU
            </button>
            <a href="/admin/produk" style="color: #ff6b6b; text-decoration: none; font-family: 'Cinzel', serif; font-size: 12px; font-weight: bold; letter-spacing: 1px;">BATAL</a>
        </div>
    </form>
</div>
@endsection
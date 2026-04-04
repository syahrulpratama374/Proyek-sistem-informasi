@extends('layouts.app')

@section('title', 'Detail Menu - ' . $menu->nama_menu)

@section('content')
<div style="padding: 30px; max-width: 800px; margin: auto;">
    <a href="/" style="text-decoration: none; color: #555; font-size: 14px;">&larr; Kembali ke Menu</a>
    
    <div style="display: flex; gap: 30px; margin-top: 20px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        
        <div style="width: 300px; height: 250px; background: #eee; display: flex; justify-content: center; align-items: center; border-radius: 8px; font-weight: bold; color: #888;">
            [Foto {{ $menu->nama_menu }}]
        </div>
        
        <div style="flex: 1;">
            <h2 style="margin-top: 0;">{{ $menu->nama_menu }}</h2>
            <h3 style="color: orange;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h3>
            
            <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">
                <span style="display: inline-block; padding: 3px 8px; background: #e9ecef; border-radius: 4px; font-size: 12px; margin-bottom: 10px;">{{ $menu->kategori }}</span><br>
                {{ $menu->deskripsi }}
            </p>
            
            <form action="/keranjang/tambah" method="POST" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                
                <label style="font-weight: bold; display: block; margin-bottom: 10px;">Jumlah Porsi:</label>
                <input type="number" name="jumlah" value="1" min="1" style="width: 70px; padding: 10px; margin-right: 15px; border: 1px solid #ccc; border-radius: 4px;">
                <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Tambah ke Keranjang</button>
            </form>
        </div>
    </div>
</div>
@endsection
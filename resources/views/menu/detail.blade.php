@extends('layouts.app')

@section('title', 'Detail Menu - ' . $menu->nama_menu)

@section('content')
<div style="padding: 30px; max-width: 900px; margin: auto;">
    <a href="/#katalog-menu" style="display: inline-block; text-decoration: none; color: #555; font-size: 14px; margin-bottom: 20px; font-weight: bold;">
        &larr; Kembali ke Katalog
    </a>
    
    <div style="display: flex; gap: 40px; background: white; padding: 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); flex-wrap: wrap;">
        
        <div style="flex: 1; min-width: 300px;">
            @if($menu->foto)
                <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" style="width: 100%; height: 350px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            @else
                <div style="width: 100%; height: 350px; background: #f8f9fa; display: flex; justify-content: center; align-items: center; border-radius: 8px; font-weight: bold; color: #adb5bd; border: 2px dashed #dee2e6;">
                    Belum Ada Foto
                </div>
            @endif
        </div>
        
        <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column;">
            
            <div style="margin-bottom: 15px;">
                <span style="display: inline-block; padding: 5px 12px; border: 1px solid #ccc; border-radius: 20px; font-size: 12px; font-weight: bold; color: #555; margin-bottom: 10px;">
                    {{ $menu->kategori }}
                </span>
                <h1 style="margin: 0 0 10px 0; color: #333; font-size: 32px;">{{ $menu->nama_menu }}</h1>
                <h2 style="margin: 0; color: #e74c3c; font-size: 28px;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h2>
            </div>
            
            <div style="margin-bottom: 30px; flex-grow: 1;">
                <h4 style="color: #333; margin-bottom: 8px; border-bottom: 1px solid #eee; padding-bottom: 8px;">Deskripsi:</h4>
                <p style="color: #555; line-height: 1.8; margin: 0;">
                    {{ $menu->deskripsi ?: 'Tidak ada deskripsi untuk menu ini.' }}
                </p>
            </div>
            
            @auth
                <form action="/keranjang/tambah" method="POST" style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #eee;">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    
                    <label style="font-weight: bold; display: block; margin-bottom: 10px; color: #333;">Tentukan Jumlah Porsi:</label>
                    
                    <div style="display: flex; gap: 15px;">
                        <input type="number" name="qty" value="1" min="1" style="width: 80px; padding: 12px; text-align: center; border: 1px solid #ccc; border-radius: 4px; font-size: 16px; font-weight: bold; outline: none;">
                        
                        <button type="submit" style="flex: 1; background: #222; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 16px;">
                            + Tambah ke Keranjang
                        </button>
                    </div>
                </form>
            @endauth

            @guest
                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; border: 1px solid #eee; text-align: center;">
                    <p style="margin-top: 0; margin-bottom: 15px; color: #e74c3c; font-weight: bold;">
                        Silakan login terlebih dahulu untuk memesan menu ini.
                    </p>
                    <a href="/login" style="display: inline-block; padding: 12px 25px; background: #222; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
                        Login Sekarang
                    </a>
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection
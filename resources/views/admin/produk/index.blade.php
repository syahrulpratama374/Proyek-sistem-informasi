@extends('admin.layouts.app')

@section('title', 'Manajemen Produk')
@section('header_title', 'Katalog Menu Ratu Minang')

@section('content')
<div style="background: #0A0805; padding: 30px; border-radius: 8px; border: 1px solid rgba(201, 168, 76, 0.2); box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
    
    <a href="/admin/produk/tambah" style="display: inline-block; padding: 12px 24px; background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; text-decoration: none; border-radius: 4px; margin-bottom: 25px; font-family: 'Cinzel', serif; font-weight: bold; letter-spacing: 1px; transition: 0.3s; box-shadow: 0 4px 15px rgba(201,168,76,0.2);">
        + TAMBAH MENU BARU
    </a>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 800px;">
            <tr style="background: rgba(201, 168, 76, 0.1); color: #C9A84C; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1.5px;">
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: center;">No</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: center;">Foto</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Nama Menu</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Kategori</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Harga</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: center;">Status</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: center;">Aksi</th>
            </tr>
            
            @forelse($menus as $index => $item)
            <tr style="transition: background 0.3s;" onmouseover="this.style.background='rgba(201, 168, 76, 0.08)'" onmouseout="this.style.background='transparent'">
                <td style="padding: 16px; text-align: center; color: rgba(250, 243, 224, 0.7); border-bottom: 1px solid rgba(201, 168, 76, 0.15);">{{ $index + 1 }}</td>
                
                <td style="padding: 16px; text-align: center; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" style="width: 55px; height: 55px; object-fit: cover; border-radius: 4px; border: 1px solid rgba(201, 168, 76, 0.4);">
                    @else
                        <div style="width: 55px; height: 55px; background: rgba(255,255,255,0.05); border: 1px dashed rgba(201,168,76,0.4); border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; font-size: 9px; color: #C9A84C; font-family: 'Cinzel', serif;">NO PIC</div>
                    @endif
                </td>
                
                <td style="padding: 16px; color: #FAF3E0; font-family: 'Playfair Display', serif; font-size: 16px; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">{{ $item->nama_menu }}</td>
                
                <td style="padding: 16px; color: rgba(250, 243, 224, 0.7); border-bottom: 1px solid rgba(201, 168, 76, 0.15);">{{ $item->kategori }}</td>
                
                <td style="padding: 16px; color: #E8C97A; font-family: 'Playfair Display', serif; font-weight: bold; font-size: 16px; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                
                <td style="padding: 16px; text-align: center; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
                    @if($item->tersedia)
                        <span style="border: 1px solid #27ae60; color: #27ae60; background: rgba(39, 174, 96, 0.1); padding: 4px 10px; border-radius: 3px; font-family: 'Cinzel', serif; font-size: 10px; font-weight: bold; letter-spacing: 1px;">TERSEDIA</span>
                    @else
                        <span style="border: 1px solid #e74c3c; color: #e74c3c; background: rgba(231, 76, 60, 0.1); padding: 4px 10px; border-radius: 3px; font-family: 'Cinzel', serif; font-size: 10px; font-weight: bold; letter-spacing: 1px;">HABIS</span>
                    @endif
                </td>
                
                <td style="padding: 16px; text-align: center; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
                    <div style="display: flex; justify-content: center; gap: 8px;">
                        <a href="/admin/produk/{{ $item->id }}/edit" style="border: 1px solid #C9A84C; color: #C9A84C; background: transparent; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-family: 'Cinzel', serif; font-size: 10px; font-weight: bold; transition: 0.3s;" onmouseover="this.style.background='#C9A84C'; this.style.color='#0A0805';" onmouseout="this.style.background='transparent'; this.style.color='#C9A84C';">EDIT</a>
                        
                        <form action="/admin/produk/{{ $item->id }}/hapus" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                            @csrf
                            <button type="submit" style="border: 1px solid #8B1A1A; color: #ff6b6b; background: transparent; padding: 6px 12px; border-radius: 4px; font-family: 'Cinzel', serif; font-size: 10px; font-weight: bold; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='#8B1A1A'; this.style.color='#FAF3E0';" onmouseout="this.style.background='transparent'; this.style.color='#ff6b6b';">HAPUS</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding: 40px; text-align: center; color: rgba(250, 243, 224, 0.4); font-family: 'Cinzel', serif; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">Belum ada menu yang ditambahkan ke dapur Ratu Minang.</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>
@endsection
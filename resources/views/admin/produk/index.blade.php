@extends('admin.layouts.app')

@section('title', 'Manajemen Produk')
@section('header_title', 'Manajemen Menu Salero Bundo')

@section('content')
<div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
    
    <a href="/admin/produk/tambah" style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px; font-weight: bold;">+ Tambah Menu Baru</a>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="background: #343a40; color: white;">
                <th style="padding: 12px; border: 1px solid #454d55; text-align: center;">No</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: center;">Foto</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Nama Menu</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Kategori</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: left;">Harga</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: center;">Status</th>
                <th style="padding: 12px; border: 1px solid #454d55; text-align: center;">Aksi</th>
            </tr>
            
            @forelse($menus as $index => $item)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px; text-align: center;">{{ $index + 1 }}</td>
                <td style="padding: 12px; text-align: center;">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                    @else
                        <div style="width: 50px; height: 50px; background: #eee; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; font-size: 10px; color: #888;">No Pic</div>
                    @endif
                </td>
                <td style="padding: 12px; font-weight: bold;">{{ $item->nama_menu }}</td>
                <td style="padding: 12px;">{{ $item->kategori }}</td>
                <td style="padding: 12px; color: #27ae60; font-weight: bold;">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td style="padding: 12px; text-align: center;">
                    @if($item->tersedia)
                        <span style="background: #d4edda; color: #155724; padding: 3px 8px; border-radius: 3px; font-size: 12px; font-weight: bold;">Tersedia</span>
                    @else
                        <span style="background: #f8d7da; color: #721c24; padding: 3px 8px; border-radius: 3px; font-size: 12px; font-weight: bold;">Habis</span>
                    @endif
                </td>
                
                <td style="padding: 12px; text-align: center;">
                    <div style="display: flex; justify-content: center; gap: 5px;">
                        <a href="/admin/produk/{{ $item->id }}/edit" style="background: #f39c12; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-size: 13px; font-weight: bold;">Edit</a>
                        
                        <form action="/admin/produk/{{ $item->id }}/hapus" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                            @csrf
                            <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 13px; font-weight: bold; cursor: pointer;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="padding: 20px; text-align: center; color: #888;">Belum ada menu yang ditambahkan.</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>
@endsection
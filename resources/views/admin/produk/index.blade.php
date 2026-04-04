@extends('admin.layouts.app')

@section('title', 'Manajemen Produk')
@section('header_title', 'Manajemen Menu Salero Bundo')

@section('content')
    <a href="/admin/produk/tambah" style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 20px; font-weight: bold;">+ Tambah Menu Baru</a>

    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <tr style="background: #343a40; color: white;">
            <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">No</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Nama Menu</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Kategori</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Harga</th>
            <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Aksi</th>
        </tr>
        
        @foreach($menus as $index => $item)
        <tr>
            <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">{{ $index + 1 }}</td>
            <td style="padding: 12px; border: 1px solid #ddd;">{{ $item->nama_menu }}</td>
            <td style="padding: 12px; border: 1px solid #ddd;">{{ $item->kategori }}</td>
            <td style="padding: 12px; border: 1px solid #ddd;">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                <a href="#" style="background: orange; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; margin-right: 5px; font-size: 14px;">Edit</a>
                <a href="#" style="background: red; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-size: 14px;">Hapus</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
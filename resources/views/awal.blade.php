@extends('layouts.app')

@section('title', 'Halaman Awal - Salero Bundo')

@section('content')
    <header style="text-align: center; padding: 50px 20px; background-color: #e9ecef;">
        <h1>Selamat Datang di Rumah Makan Padang Salero Bundo</h1>
        <p>Nikmati cita rasa otentik masakan Padang langsung dari genggaman Anda.</p>
        <a href="#menu" style="padding: 10px 20px; background: orange; color: white; text-decoration: none; border-radius: 5px;">Lihat Menu</a>
    </header>

    <section id="menu" style="padding: 30px;">
        <h3 style="text-align: center; margin-bottom: 20px;">Rekomendasi Menu Kami</h3>
        
        <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            @foreach($menus as $item)
            <div style="background: white; border: 1px solid #ddd; padding: 15px; width: 220px; border-radius: 8px; text-align: center;">
                
                @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_menu }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 4px; margin-bottom: 10px;">
                @else
                    <div style="height: 120px; background: #eee; margin-bottom: 10px; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #888; font-size: 12px;">
                        Tanpa Foto
                    </div>
                @endif
                <h4>{{ $item->nama_menu }}</h4>
                <p style="color: orange; font-weight: bold;">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                <a href="/menu/{{ $item->id }}" style="display: inline-block; padding: 8px 15px; background: #333; color: white; text-decoration: none; border-radius: 4px; font-size: 14px;">Detail Menu</a>
            </div>
            @endforeach
        </div>
    </section> 
@endsection
@extends('layouts.app')

@section('title', 'Halaman Awal - Salero Bundo')

@section('content')
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 40px; background-color: #fff; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <div style="flex: 1;">
            <p style="color: #666; font-size: 14px; letter-spacing: 1px; margin-bottom: 5px;">CITA RASA ASLI MINANG</p>
            <h1 style="margin-top: 0; font-size: 32px; color: #333;">Pesan Makanan<br>Padang Favoritmu</h1>
            <p style="color: #666; line-height: 1.6;">Nikmati rendang, gulai, dan aneka lauk khas Minang segar setiap hari. Pesan langsung dari meja Anda!</p>
            <div style="margin-top: 20px;">
                <a href="#katalog-menu" style="padding: 10px 25px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; margin-right: 10px;">Pesan Sekarang</a>
                <a href="#katalog-menu" style="padding: 10px 25px; background: white; color: #333; border: 1px solid #ddd; text-decoration: none; border-radius: 5px; font-weight: bold;">Lihat Menu</a>
            </div>
        </div>
        <div style="flex: 1; text-align: right;">
            <img src="{{ asset('images/menu_utama.jpg') }}" alt="Ilustrasi Salero Bundo" style="width: 100%; max-width: 400px; height: 250px; object-fit: cover; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        </div>
    </header>

    <section style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 15px; flex-wrap: wrap; gap: 15px;">
        
        <div style="display: flex; gap: 10px; overflow-x: auto;">
            <a href="/" style="padding: 8px 15px; background: {{ !request('kategori') ? '#333' : 'white' }}; color: {{ !request('kategori') ? 'white' : '#333' }}; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: bold; border: 1px solid #ddd;">Semua</a>
            
            <a href="/?kategori=Lauk Utama" style="padding: 8px 15px; background: {{ request('kategori') == 'Lauk Utama' ? '#333' : 'white' }}; color: {{ request('kategori') == 'Lauk Utama' ? 'white' : '#333' }}; border: 1px solid #ddd; text-decoration: none; border-radius: 4px; font-size: 14px;">Lauk Utama</a>
            
            <a href="/?kategori=Sayuran" style="padding: 8px 15px; background: {{ request('kategori') == 'Sayuran' ? '#333' : 'white' }}; color: {{ request('kategori') == 'Sayuran' ? 'white' : '#333' }}; border: 1px solid #ddd; text-decoration: none; border-radius: 4px; font-size: 14px;">Sayuran</a>
            
            <a href="/?kategori=Nasi & Karbohidrat" style="padding: 8px 15px; background: {{ request('kategori') == 'Nasi & Karbohidrat' ? '#333' : 'white' }}; color: {{ request('kategori') == 'Nasi & Karbohidrat' ? 'white' : '#333' }}; border: 1px solid #ddd; text-decoration: none; border-radius: 4px; font-size: 14px;">Nasi & Karbohidrat</a>
            
            <a href="/?kategori=Minuman" style="padding: 8px 15px; background: {{ request('kategori') == 'Minuman' ? '#333' : 'white' }}; color: {{ request('kategori') == 'Minuman' ? 'white' : '#333' }}; border: 1px solid #ddd; text-decoration: none; border-radius: 4px; font-size: 14px;">Minuman</a>
        </div>

        <div>
            <form action="/" method="GET" style="margin: 0; display: flex; gap: 5px;">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="🔍 Cari Menu..." style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 4px; outline: none;">
                <button type="submit" style="display: none;">Cari</button>
            </form>
        </div>
    </section>

   <section id="katalog-menu">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; color: #333;">Menu Tersedia</h3>
            <span style="font-size: 14px; color: #666;">Menampilkan {{ count($menus) }} menu</span>
        </div>
        
        <div style="display: flex; gap: 20px; overflow-x: auto; padding-bottom: 15px; scroll-snap-type: x mandatory;">
            @forelse($menus as $item)
                <div style="flex: 0 0 auto; width: 250px; scroll-snap-align: start; background: white; border: 1px solid #e0e0e0; padding: 15px; border-radius: 8px; box-sizing: border-box; display: flex; flex-direction: column;">
                    
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_menu }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 6px; margin-bottom: 10px;">
                    @else
                        <div style="width: 100%; height: 150px; background: #f8f9fa; margin-bottom: 10px; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #adb5bd; border: 1px dashed #dee2e6;">
                            Tanpa Foto
                        </div>
                    @endif
                    
                    <div style="flex-grow: 1;">
                        <h4 style="margin: 0 0 5px 0; color: #333; font-size: 16px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $item->nama_menu }}">{{ $item->nama_menu }}</h4>
                        
                        <div style="margin-bottom: 10px;">
                            <span style="display: inline-block; padding: 3px 6px; border: 1px solid #27ae60; color: #27ae60; font-size: 10px; font-weight: bold; border-radius: 3px; margin-right: 5px;">TERSEDIA</span>
                            <span style="font-size: 12px; color: #888;">{{ $item->kategori }}</span>
                        </div>
                        <p style="color: #e74c3c; font-weight: bold; font-size: 18px; margin: 0 0 15px 0;">{{ $item->harga_rupiah ?? 'Rp ' . number_format($item->harga, 0, ',', '.') }}</p>
                    </div>

                    <div style="display: flex; gap: 8px; margin-top: auto;">
                        <a href="/menu/{{ $item->id }}" style="flex: 1; text-align: center; padding: 8px; background: #f1f3f5; color: #333; text-decoration: none; border-radius: 4px; font-size: 13px; font-weight: bold;">Detail</a>
                        
                        @auth
                            <form action="/keranjang/tambah" method="POST" style="flex: 2; margin: 0;">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $item->id }}">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" style="width: 100%; padding: 8px; background: #333; color: white; border: none; border-radius: 4px; font-size: 13px; font-weight: bold; cursor: pointer;">
                                    + Tambah
                                </button>
                            </form>
                        @endauth

                        @guest
                            <a href="/login" style="flex: 2; text-align: center; padding: 8px; background: #333; color: white; border: none; border-radius: 4px; font-size: 13px; font-weight: bold; text-decoration: none; display: block;">
                                + Tambah
                            </a>
                        @endguest
                    </div>
                </div>
            @empty
                <div style="width: 100%; text-align: center; padding: 50px; background: white; border-radius: 8px; border: 1px dashed #ccc; color: #888;">
                    Menu tidak ditemukan.
                </div>
            @endforelse
        </div>
    </section>
@endsection
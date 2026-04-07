@extends('layouts.app')

@section('title', 'Keranjang Pesanan - Salero Bundo')

@section('content')
<div style="padding: 30px; max-width: 1100px; margin: auto;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 30px;">
        <h2 style="margin: 0;">Keranjang Pesanan</h2>
        @if(session('keranjang'))
            <span style="background: #e9ecef; padding: 5px 15px; border-radius: 20px; font-weight: bold; color: #555;">
                🛒 {{ count(session('keranjang')) }} Item
            </span>
        @endif
    </div>

    <div style="display: flex; gap: 30px; flex-wrap: wrap;">
        
        <div style="flex: 2; min-width: 60%; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            @php 
                $total_belanja = 0; 
                $total_item = 0;
            @endphp
            
            @if(session('keranjang') && count(session('keranjang')) > 0)
                @foreach(session('keranjang') as $id => $item)
                    @php 
                        // MENGGUNAKAN 'qty' SESUAI CONTROLLER
                        $subtotal = $item['harga'] * $item['qty'];
                        $total_belanja += $subtotal;
                        $total_item += $item['qty'];
                    @endphp
                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed #ddd; padding: 20px 0;">
                        
                        <div style="display: flex; gap: 15px; align-items: center; flex: 2;">
                            <div style="width: 60px; height: 60px; background: #e9ecef; border-radius: 6px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #aaa;">
                                FOTO
                            </div>
                            <div>
                                <h4 style="margin: 0 0 5px 0; color: #333;">{{ $item['nama_menu'] }}</h4>
                                <span style="color: #666; font-size: 13px;">Rp {{ number_format($item['harga'], 0, ',', '.') }} / porsi</span>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 10px; flex: 1; justify-content: center;">
                            <button style="padding: 5px 10px; border: 1px solid #ccc; background: white; cursor: not-allowed; border-radius: 3px;">-</button>
                            <span style="font-weight: bold; width: 20px; text-align: center;">{{ $item['qty'] }}</span>
                            <button style="padding: 5px 10px; border: 1px solid #ccc; background: white; cursor: not-allowed; border-radius: 3px;">+</button>
                        </div>

                        <div style="font-weight: bold; font-size: 16px; color: #333; flex: 1; text-align: right;">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; padding: 50px; color: #888;">
                    <h3 style="margin-bottom: 10px; color: #555;">Keranjang Anda masih kosong</h3>
                    <p style="margin-bottom: 20px;">Yuk pilih hidangan Padang favoritmu terlebih dahulu!</p>
                    <a href="/#katalog-menu" style="padding: 10px 25px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">Lihat Menu</a>
                </div>
            @endif
        </div>

        @if(session('keranjang') && count(session('keranjang')) > 0)
        <div style="flex: 1; min-width: 300px; background: #f8f9fa; padding: 25px; border-radius: 8px; border: 1px solid #ddd; height: fit-content;">
            <h3 style="margin-top: 0; border-bottom: 1px dashed #ccc; padding-bottom: 15px; margin-bottom: 20px; color: #333;">Ringkasan</h3>
            
            <div style="display: flex; justify-content: space-between; margin-bottom: 12px; color: #555; font-size: 15px;">
                <span>Subtotal ({{ $total_item }} menu)</span>
                <span>Rp {{ number_format($total_belanja, 0, ',', '.') }}</span>
            </div>
            
            <div style="display: flex; justify-content: space-between; margin-bottom: 25px; color: #555; font-size: 15px;">
                <span>Biaya layanan</span>
                <span style="color: #27ae60; font-weight: bold;">Gratis</span>
            </div>

            <div style="display: flex; justify-content: space-between; border-top: 2px solid #ddd; padding-top: 15px; margin-bottom: 30px;">
                <span style="font-weight: bold; font-size: 18px; color: #333;">TOTAL</span>
                <span style="font-weight: bold; font-size: 18px; color: #e74c3c;">Rp {{ number_format($total_belanja, 0, ',', '.') }}</span>
            </div>

            <a href="/checkout" style="display: block; width: 100%; padding: 12px; background: #222; color: white; text-align: center; text-decoration: none; font-weight: bold; border-radius: 4px; margin-bottom: 12px; box-sizing: border-box;">
                Lanjut ke Pembayaran &rarr;
            </a>
            
            <a href="/#katalog-menu" style="display: block; width: 100%; padding: 10px; background: white; color: #333; text-align: center; text-decoration: none; border: 1px solid #ccc; font-weight: bold; border-radius: 4px; box-sizing: border-box; font-size: 14px;">
                + Tambah Menu Lagi
            </a>
        </div>
        @endif

    </div>
</div>
@endsection
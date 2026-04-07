@extends('layouts.app')

@section('title', 'Konfirmasi Pesanan - Salero Bundo')

@section('content')
<div style="padding: 30px; max-width: 1100px; margin: auto;">
    
    <h2 style="margin-bottom: 20px; color: #333;">Konfirmasi Pesanan</h2>

    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 30px; font-weight: bold; font-size: 14px; color: #666;">
        <span style="padding: 5px 15px; border: 1px solid #ccc; border-radius: 4px; background: white;">1. Keranjang</span>
        <span>────</span>
        <span style="padding: 5px 15px; border: 1px solid #333; border-radius: 4px; background: #e9ecef; color: #333;">2. Konfirmasi</span>
        <span>────</span>
        <span style="padding: 5px 15px; border: 1px solid #ccc; border-radius: 4px; background: white;">3. Selesai</span>
    </div>

    @if ($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/checkout/proses" method="POST" style="display: flex; gap: 30px; flex-wrap: wrap; align-items: flex-start;">
        @csrf
        
        <div style="flex: 2; min-width: 60%; display: flex; flex-direction: column; gap: 20px;">
            
            <div style="background: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">
                <h4 style="margin-top: 0; margin-bottom: 15px; color: #333; text-transform: uppercase;">Detail Meja</h4>
                <label style="display: block; font-weight: bold; margin-bottom: 8px;">Nomor Meja <span style="color: red;">*</span></label>
                <input type="text" name="nomor_meja" value="{{ old('nomor_meja') }}" required placeholder="Contoh: Meja 05" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 16px;">
            </div>

            <div style="background: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">
                <h4 style="margin-top: 0; margin-bottom: 15px; color: #333; text-transform: uppercase;">Metode Pembayaran</h4>
                
                <label style="display: flex; align-items: center; padding: 15px; border: 1px solid #333; border-radius: 4px; margin-bottom: 10px; background: #f8f9fa; cursor: pointer;">
                    <input type="radio" name="metode_pembayaran" value="tunai" checked style="margin-right: 15px; transform: scale(1.2);">
                    <span style="font-weight: bold;">Bayar di Kasir (Tunai/Cash)</span>
                </label>

                <label style="display: flex; align-items: center; padding: 15px; border: 1px dashed #ccc; border-radius: 4px; margin-bottom: 10px; cursor: pointer;">
                    <input type="radio" name="metode_pembayaran" value="transfer" style="margin-right: 15px; transform: scale(1.2);">
                    <span>Transfer Bank</span>
                    <span style="margin-left: auto; background: #e9ecef; padding: 3px 8px; font-size: 11px; font-weight: bold; border-radius: 3px; color: #666;">TERSEDIA</span>
                </label>

                <label style="display: flex; align-items: center; padding: 15px; border: 1px dashed #ccc; border-radius: 4px; cursor: pointer;">
                    <input type="radio" name="metode_pembayaran" value="qris" style="margin-right: 15px; transform: scale(1.2);">
                    <span>QRIS</span>
                    <span style="margin-left: auto; background: #e9ecef; padding: 3px 8px; font-size: 11px; font-weight: bold; border-radius: 3px; color: #666;">TERSEDIA</span>
                </label>
            </div>

            <div style="background: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">
                <h4 style="margin-top: 0; margin-bottom: 15px; color: #333; text-transform: uppercase;">Catatan Untuk Dapur (Opsional)</h4>
                <textarea name="catatan" rows="3" placeholder="Instruksi khusus, pedas, pisah kuah, dll..." style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-family: inherit;">{{ old('catatan') }}</textarea>
            </div>

        </div>

        <div style="flex: 1; min-width: 300px; background: #f8f9fa; padding: 25px; border-radius: 8px; border: 1px solid #ddd; position: sticky; top: 20px;">
            <h3 style="margin-top: 0; border-bottom: 1px dashed #ccc; padding-bottom: 15px; margin-bottom: 20px; color: #333;">Ringkasan Pesanan</h3>
            
            @php $total_belanja = 0; @endphp
            
            <ul style="list-style: none; padding: 0; margin-bottom: 20px; font-size: 14px;">
                @foreach($keranjang as $item)
                    @php 
                        $subtotal = $item['harga'] * $item['qty']; // SUDAH MENGGUNAKAN QTY
                        $total_belanja += $subtotal;
                    @endphp
                    <li style="display: flex; justify-content: space-between; margin-bottom: 12px; border-bottom: 1px dashed #eee; padding-bottom: 12px;">
                        <span style="color: #555;">{{ $item['nama_menu'] }} <span style="font-weight: bold;">x {{ $item['qty'] }}</span></span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            
            <div style="display: flex; justify-content: space-between; border-top: 2px solid #ccc; padding-top: 15px; margin-bottom: 25px;">
                <span style="font-weight: bold; font-size: 18px; color: #333;">TOTAL</span>
                <span style="font-weight: bold; font-size: 18px; color: #e74c3c;">Rp {{ number_format($total_belanja, 0, ',', '.') }}</span>
            </div>

            <button type="submit" style="display: block; width: 100%; padding: 15px; background: #222; color: white; text-align: center; text-decoration: none; font-weight: bold; border-radius: 4px; border: none; cursor: pointer; font-size: 16px;">
                ✓ PESAN SEKARANG
            </button>
            <p style="text-align: center; font-size: 11px; color: #888; margin-top: 10px; line-height: 1.4;">
                Dengan memesan, Anda setuju dengan syarat & ketentuan yang berlaku.
            </p>
        </div>

    </form>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Riwayat Pesanan - Salero Bundo')

@section('content')
<div style="max-width: 800px; margin: 40px auto; padding: 20px;">
    <h2 style="text-align: center; margin-bottom: 30px; color: #333;">📜 Riwayat Pesanan Saya</h2>

    @forelse($pesanans as $pesanan)
        <div style="background: white; border: 1px solid #e0e0e0; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); overflow: hidden;">
            
            <div style="background: #f8f9fa; padding: 15px 20px; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <div>
                    <span style="font-weight: bold; color: #333; font-size: 16px;">{{ $pesanan->kode_pesanan }}</span>
                    <span style="color: #888; font-size: 14px; margin-left: 10px;">{{ $pesanan->created_at->format('d M Y, H:i') }}</span>
                </div>
                
                <div>
                    @if($pesanan->status == 'pending')
                        <span style="background: #fff3cd; color: #856404; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">⏳ Menunggu Proses</span>
                    @elseif($pesanan->status == 'diproses')
                        <span style="background: #cce5ff; color: #004085; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">🍳 Sedang Dimasak</span>
                    @elseif($pesanan->status == 'selesai')
                        <span style="background: #d4edda; color: #155724; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">✅ Selesai</span>
                    @else
                        <span style="background: #f8d7da; color: #721c24; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">❌ Dibatalkan</span>
                    @endif
                </div>
            </div>

            <div style="padding: 20px;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @foreach($pesanan->detailPesanans as $detail)
                        <li style="display: flex; justify-content: space-between; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px dashed #eee;">
                            
                            <div style="display: flex; align-items: center; gap: 15px;">
                                @if($detail->menu && $detail->menu->foto)
                                    <img src="{{ asset('storage/' . $detail->menu->foto) }}" alt="{{ $detail->menu->nama_menu }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div style="width: 50px; height: 50px; background: #eee; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;">Tanpa Foto</div>
                                @endif

                                <div>
                                    <span style="font-weight: bold; color: #333; font-size: 15px;">
                                        {{ $detail->menu ? $detail->menu->nama_menu : 'Menu Tidak Tersedia/Dihapus' }}
                                    </span>
                                    <span style="color: #666; font-size: 14px; margin-left: 5px;">x {{ $detail->qty }} porsi</span>
                                </div>
                            </div>

                            <div style="font-weight: bold; color: #555;">
                                Rp {{ number_format($detail->harga_satuan * $detail->qty, 0, ',', '.') }}
                            </div>

                        </li>
                    @endforeach
                </ul>

                @if($pesanan->catatan)
                    <div style="background: #fff8e1; padding: 10px; border-radius: 4px; font-size: 13px; color: #666; margin-top: 10px;">
                        <strong>📝 Catatan Pesanan:</strong> {{ $pesanan->catatan }}
                    </div>
                @endif

                <div style="margin-top: 20px; text-align: right; border-top: 2px solid #f8f9fa; padding-top: 15px;">
                    <span style="font-size: 14px; color: #666;">Total Belanja:</span>
                    <span style="font-size: 20px; font-weight: bold; color: orange; margin-left: 10px;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>

        </div>
    @empty
        <div style="text-align: center; padding: 50px; background: white; border-radius: 8px; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="font-size: 50px; margin-bottom: 15px;">🍽️</div>
            <h3 style="color: #555; margin-bottom: 10px;">Belum Ada Riwayat Pesanan</h3>
            <p style="color: #888; margin-bottom: 25px;">Perut keroncongan? Ayo pesan masakan Padang favoritmu sekarang!</p>
            <a href="/" style="background: orange; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 16px;">Lihat Menu</a>
        </div>
    @endforelse
</div>
@endsection
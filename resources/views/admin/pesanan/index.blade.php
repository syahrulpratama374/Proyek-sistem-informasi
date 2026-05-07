@extends('admin.layouts.app')

@section('title', 'Kelola Pesanan Masuk')
@section('header_title', 'Daftar Pesanan Masuk')

@section('content')
<div style="background: #0A0805; padding: 30px; border-radius: 8px; border: 1px solid rgba(201, 168, 76, 0.2); box-shadow: 0 4px 15px rgba(0,0,0,0.5);">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h4 style="margin: 0; color: #E8C97A; font-family: 'Playfair Display', serif; font-size: 20px;">Pantauan Dapur & Kurir</h4>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; min-width: 900px;">
            <tr style="background: rgba(201, 168, 76, 0.1); color: #C9A84C; font-family: 'Cinzel', serif; font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase;">
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Waktu</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Kode / Pelanggan</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: left;">Tipe & Tujuan</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: center;">Status</th>
                <th style="padding: 16px; border-bottom: 2px solid #C9A84C; text-align: center;">Aksi Kasir</th>
            </tr>

            @forelse($pesanans as $item)
            <tr style="transition: background 0.3s;" onmouseover="this.style.background='rgba(201, 168, 76, 0.08)'" onmouseout="this.style.background='transparent'">
                
                <td style="padding: 16px; color: rgba(250, 243, 224, 0.7); border-bottom: 1px solid rgba(201, 168, 76, 0.15); font-size: 13px;">
                    {{ $item->created_at->format('d M') }}<br>
                    <strong style="color: #E8C97A;">{{ $item->created_at->format('H:i') }}</strong>
                </td>

                <td style="padding: 16px; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
                    <div style="color: #C9A84C; font-weight: bold; font-family: 'Cinzel', serif; letter-spacing: 1px; margin-bottom: 4px;">{{ $item->kode_pesanan }}</div>
                    <div style="color: #FAF3E0; font-size: 13px;">👤 {{ $item->user->name ?? 'Guest/Kasir' }}</div>
                </td>

                <td style="padding: 16px; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
                    @if(strlen($item->nomor_meja) > 10)
                        <span style="color: #3498db; font-size: 10px; font-weight: bold; font-family: 'Cinzel', serif; letter-spacing: 1px;">🚚 PESAN ANTAR</span><br>
                        <div style="color: rgba(250, 243, 224, 0.7); font-size: 12px; margin-top: 4px; line-height: 1.4;">{{ $item->nomor_meja }}</div>
                    @else
                        <span style="color: #f39c12; font-size: 10px; font-weight: bold; font-family: 'Cinzel', serif; letter-spacing: 1px;">🍽️ MAKAN DI TEMPAT</span><br>
                        <div style="color: rgba(250, 243, 224, 0.7); font-size: 13px; margin-top: 4px;">Meja: <strong style="color: #FAF3E0;">{{ $item->nomor_meja }}</strong></div>
                    @endif
                </td>

                <td style="padding: 16px; text-align: center; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
                    @if($item->status == 'pending')
                        <span style="border: 1px solid #e67e22; color: #e67e22; background: rgba(230, 126, 34, 0.1); padding: 5px 12px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase;">Menunggu</span>
                    @elseif($item->status == 'diproses')
                        <span style="border: 1px solid #3498db; color: #3498db; background: rgba(52, 152, 219, 0.1); padding: 5px 12px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase;">Dimasak</span>
                    @elseif($item->status == 'diantar')
                        <span style="border: 1px solid #9b59b6; color: #9b59b6; background: rgba(155, 89, 182, 0.1); padding: 5px 12px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase;">Di Jalan</span>
                    @elseif($item->status == 'selesai')
                        <span style="border: 1px solid #27ae60; color: #27ae60; background: rgba(39, 174, 96, 0.1); padding: 5px 12px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase;">Selesai</span>
                    @else
                        <span style="border: 1px solid #e74c3c; color: #e74c3c; background: rgba(231, 76, 60, 0.1); padding: 5px 12px; border-radius: 4px; font-size: 10px; font-weight: bold; text-transform: uppercase;">Batal</span>
                    @endif
                </td>

               <td style="padding: 16px; text-align: center; border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
                    <div style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                        
                        <!-- 🌟 TOMBOL BARU: MASUK KE HALAMAN DETAIL & CETAK STRUK 🌟 -->
                        <a href="/admin/pesanan/{{ $item->id }}" style="background: rgba(201, 168, 76, 0.1); border: 1px solid #C9A84C; color: #E8C97A; padding: 7px 12px; border-radius: 4px; text-decoration: none; font-weight: bold; font-family: 'Cinzel', serif; font-size: 10px; transition: 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                            👁️ DETAIL
                        </a>

                        <!-- FORM UPDATE STATUS LAMA MILIKMU -->
                        <form action="/admin/pesanan/{{ $item->id }}/status" method="POST" style="margin: 0; display: flex; gap: 8px;">
                            @csrf
                            <select name="status" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(201, 168, 76, 0.4); color: #FAF3E0; padding: 7px; border-radius: 4px; font-size: 12px; outline: none;">
                                <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }} style="background: #0A0805;">Pending</option>
                                <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }} style="background: #0A0805;">Diproses</option>
                                <option value="diantar" {{ $item->status == 'diantar' ? 'selected' : '' }} style="background: #0A0805;">Diantar</option>
                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }} style="background: #0A0805;">Selesai</option>
                                <option value="batal" {{ $item->status == 'batal' ? 'selected' : '' }} style="background: #0A0805;">Batal</option>
                            </select>
                            <button type="submit" style="background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; border: none; padding: 8px 12px; border-radius: 4px; font-weight: bold; font-family: 'Cinzel', serif; font-size: 10px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(201,168,76,0.2);">UPDATE</button>
                        </form>

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 60px; text-align: center; color: rgba(250, 243, 224, 0.4); border-bottom: 1px solid rgba(201, 168, 76, 0.15);">
                    <div style="font-size: 30px; margin-bottom: 10px; opacity: 0.5;">🛒</div>
                    <div style="font-family: 'Cinzel', serif; letter-spacing: 1px;">Belum ada pesanan yang masuk ke dapur.</div>
                </td>
            </tr>
            @endforelse
        </table>
    </div>

</div>
@endsection
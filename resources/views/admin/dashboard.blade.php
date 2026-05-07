@extends('admin.layouts.app')

@section('header_title', 'Dashboard Ringkasan')

@section('content')

<style>
    .rm-dash-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .rm-stat-card {
        background: linear-gradient(145deg, rgba(26,18,8,0.9), rgba(10,8,5,0.95));
        border: 1px solid rgba(201, 168, 76, 0.15);
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
        position: relative;
        overflow: hidden;
    }
    .rm-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(201, 168, 76, 0.1);
        border-color: rgba(201, 168, 76, 0.4);
    }
    .rm-stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 4px;
    }
    .border-green::before { background: linear-gradient(90deg, #28a745, #20c997); }
    .border-red::before { background: linear-gradient(90deg, #dc3545, #ff6b6b); }
    .border-gold::before { background: linear-gradient(90deg, #C9A84C, #E8C97A); }
    .border-blue::before { background: linear-gradient(90deg, #17a2b8, #36b9cc); }

    .rm-stat-title {
        font-family: 'Cinzel', serif;
        font-size: 11px;
        color: rgba(250, 243, 224, 0.6);
        letter-spacing: 2px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    .rm-stat-value {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        font-weight: 700;
        color: #E8C97A;
    }
    .rm-stat-value.text-red { color: #ff6b6b; }
    .rm-stat-value.text-green { color: #20c997; }

    .rm-panel-wrapper {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }
    @media (max-width: 992px) {
        .rm-panel-wrapper { grid-template-columns: 1fr; }
    }

    .rm-panel {
        background: linear-gradient(145deg, rgba(26,18,8,0.9), rgba(10,8,5,0.95));
        border: 1px solid rgba(201, 168, 76, 0.15);
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .rm-panel-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        color: #E8C97A;
        margin: 0 0 20px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>

<div class="rm-dash-grid">
    <div class="rm-stat-card border-green">
        <div class="rm-stat-title">Pesanan Hari Ini</div>
        <div class="rm-stat-value text-green">{{ $pesanan_hari_ini ?? '0' }}</div>
    </div>
    <div class="rm-stat-card border-red">
        <div class="rm-stat-title">Perlu Diproses</div>
        <div class="rm-stat-value text-red">{{ $perlu_diproses ?? '0' }}</div>
    </div>
    <div class="rm-stat-card border-gold">
        <div class="rm-stat-title">Total Pelanggan</div>
        <div class="rm-stat-value">{{ $total_pelanggan ?? '0' }}</div>
    </div>
    <div class="rm-stat-card border-blue">
        <div class="rm-stat-title">Menu Aktif</div>
        <div class="rm-stat-value">{{ $menu_aktif ?? '0' }}</div>
    </div>
</div>

@if(auth()->user()->role == 'admin')
    <div class="rm-panel-wrapper">
        <div class="rm-panel">
            <h4 class="rm-panel-title"><span>📈</span> Grafik Pendapatan 7 Hari Terakhir</h4>
            <canvas id="grafikPenjualan" height="120"></canvas>
        </div>

        <div class="rm-panel" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h4 class="rm-panel-title"><span>👑</span> Panel Admin Restoran</h4>
                <p style="font-size: 14px; color: rgba(250, 243, 224, 0.7); line-height: 1.8;">
                    Selamat datang kembali, <b style="color: #E8C97A;">{{ auth()->user()->name }}</b>.<br><br>
                    Sistem sedang memantau performa penjualan warung secara real-time. Semua data transaksi, stok menu, dan laporan tercatat otomatis di server Ratu Minang.
                </p>
            </div>
            <a href="/admin/laporan" style="display: block; text-align: center; background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; padding: 14px; border-radius: 6px; text-decoration: none; font-weight: bold; font-family: 'Cinzel', serif; margin-top: 25px; transition: 0.3s; box-shadow: 0 4px 15px rgba(201,168,76,0.3);">
                BUKA LAPORAN LENGKAP
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('grafikPenjualan').getContext('2d');
            
            // Membuat gradien warna emas yang elegan untuk chart
            let gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
            gradientFill.addColorStop(0, 'rgba(201, 168, 76, 0.4)');
            gradientFill.addColorStop(1, 'rgba(201, 168, 76, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: [150000, 230000, 180000, 340000, 290000, 550000, 620000], // (Untuk sementara ini data dummy, nanti bisa dibuat dinamis seperti kartu di atas)
                        backgroundColor: gradientFill,
                        borderColor: '#E8C97A',
                        pointBackgroundColor: '#0A0805',
                        pointBorderColor: '#E8C97A',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderWidth: 2, 
                        fill: true, 
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { 
                        legend: { display: false }, 
                        tooltip: { backgroundColor: 'rgba(10, 8, 5, 0.9)', titleColor: '#E8C97A', bodyColor: '#FAF3E0', borderColor: 'rgba(201,168,76,0.3)', borderWidth: 1 } 
                    },
                    scales: {
                        x: { grid: { color: 'rgba(250, 243, 224, 0.05)' }, ticks: { color: 'rgba(250, 243, 224, 0.5)', font: { family: 'Nunito Sans' } } },
                        y: { grid: { color: 'rgba(250, 243, 224, 0.05)' }, ticks: { color: 'rgba(250, 243, 224, 0.5)', font: { family: 'Nunito Sans' } }, beginAtZero: true }
                    }
                }
            });
        });
    </script>

@elseif(auth()->user()->role == 'kasir')
    <div class="rm-panel">
        <h4 class="rm-panel-title" style="font-size: 24px;">Selamat Datang, Kasir Utama</h4>
        <p style="font-size: 15px; color: rgba(250, 243, 224, 0.7); line-height: 1.6; margin-bottom: 30px;">
            Anda bertugas mengatur alur pemesanan hari ini. Pastikan melayani pesanan dengan cepat dan menjaga keakuratan stok menu.
        </p>

        <div style="display: flex; gap: 15px; flex-wrap: wrap; font-family: 'Cinzel', serif;">
            <a href="/admin/pos" style="background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; padding: 14px 24px; border-radius: 6px; text-decoration: none; font-weight: bold; box-shadow: 0 4px 15px rgba(201,168,76,0.3); transition: 0.3s;">🖥️ BUKA POS KASIR</a>
            <a href="/admin/pesanan" style="border: 1px solid #C9A84C; color: #C9A84C; padding: 14px 24px; border-radius: 6px; text-decoration: none; font-weight: bold; background: rgba(201,168,76,0.1); transition: 0.3s;">🛒 PESANAN MASUK</a>
            <a href="/admin/produk" style="border: 1px solid rgba(250,243,224,0.2); color: var(--cream); padding: 14px 24px; border-radius: 6px; text-decoration: none; background: rgba(255,255,255,0.02); transition: 0.3s;">🍱 KELOLA MENU</a>
        </div>
    </div>
@endif

@endsection
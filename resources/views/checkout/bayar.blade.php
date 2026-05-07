@extends('layouts.app')

@section('title', 'Selesaikan Pembayaran - Ratu Minang')

@section('content')
<div style="background: var(--dark, #1A1208); padding: 50px 20px; min-height: 70vh; display: flex; align-items: center; justify-content: center; font-family: 'Nunito Sans', sans-serif;">
    
    <div style="background: linear-gradient(145deg, #0A0805, #1A1208); padding: 40px; border-radius: 8px; border: 1px solid rgba(201, 168, 76, 0.3); max-width: 450px; width: 100%; text-align: center; box-shadow: 0 10px 30px rgba(0,0,0,0.8);">
        
        <h2 style="color: #E8C97A; font-family: 'Playfair Display', serif; margin-bottom: 20px; font-size: 28px;">Selesaikan Pembayaran</h2>
        
        <p style="color: rgba(250, 243, 224, 0.7); margin-bottom: 5px; font-size: 14px;">Kode Pesanan Anda</p>
        <p style="color: #C9A84C; font-weight: bold; font-family: 'Cinzel', serif; letter-spacing: 2px; font-size: 18px; margin-top: 0;">{{ $pesananBaru->kode_pesanan }}</p>
        
        <hr style="border-color: rgba(201, 168, 76, 0.2); margin: 25px 0;">

        <p style="color: rgba(250, 243, 224, 0.7); margin-bottom: 10px; font-size: 14px;">Total Tagihan</p>
        <h1 style="color: #C9A84C; font-family: 'Playfair Display', serif; margin-top: 0; margin-bottom: 35px; text-shadow: 0 2px 10px rgba(201, 168, 76, 0.2);">Rp {{ number_format($pesananBaru->total_harga, 0, ',', '.') }}</h1>

        <button id="pay-button" style="background: linear-gradient(135deg, #8B6914, #C9A84C); color: #0A0805; padding: 15px 30px; border: none; border-radius: 4px; font-family: 'Cinzel', serif; font-weight: bold; font-size: 14px; letter-spacing: 1.5px; cursor: pointer; transition: 0.3s; width: 100%; box-shadow: 0 4px 15px rgba(201,168,76,0.3);">
            LAKUKAN PEMBAYARAN
        </button>
        
        <p style="color: rgba(250, 243, 224, 0.4); font-size: 11px; margin-top: 20px; font-style: italic;">Sistem Pembayaran Aman Terenkripsi oleh Midtrans</p>
    </div>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-Y0CfnlnLs0t6Vfm-"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
            // JIKA SUKSES: Kirimkan kode pesanan ke halaman sukses untuk diubah statusnya
            onSuccess: function(result){
                window.location.href = '/checkout/sukses?order_id={{ $pesananBaru->kode_pesanan }}';
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda!");
                window.location.href = '/checkout/sukses';
            },
            onError: function(result){
                alert("Pembayaran gagal!");
            },
            onClose: function(){
                alert('Anda menutup layar pembayaran tanpa menyelesaikannya.');
            }
        });
    };
</script>
@endsection
@extends('admin.layouts.app')

@section('title', 'POS Kasir - Ratu Minang')
@section('header_title', 'Point of Sale (Mesin Kasir)')

@section('content')
<style>
    /* Styling Khusus Input */
    .rm-pos-input { 
        width: 100%; padding: 14px 15px; /* Padding dibesarkan untuk layar sentuh */
        background: rgba(255, 255, 255, 0.05); /* Sedikit lebih terang */
        border: 1px solid rgba(201, 168, 76, 0.4); 
        border-radius: 6px; color: #FAF3E0; 
        font-family: 'Nunito Sans', sans-serif; box-sizing: border-box; transition: 0.3s; 
        font-size: 14px;
    }
    .rm-pos-input:focus { outline: none; border-color: #C9A84C; background: rgba(201, 168, 76, 0.1); }
    .rm-pos-input::placeholder { color: rgba(250, 243, 224, 0.5); } /* Kontras teks ditingkatkan */
    select.rm-pos-input option { background: #0A0805; color: #FAF3E0; }
    
    /* Layout Responsif dengan CSS Grid & Flexbox */
    .rm-pos-container {
        display: flex; gap: 20px; align-items: flex-start;
    }
    .rm-pos-menu-area {
        flex: 2; min-width: 0; 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); 
        gap: 15px;
    }
    .rm-pos-cart-area {
        flex: 1; min-width: 350px; 
        background: #0A0805; padding: 25px; border-radius: 8px; 
        box-shadow: 0 4px 20px rgba(0,0,0,0.6); border: 1px solid rgba(201, 168, 76, 0.3); 
        position: sticky; top: 20px;
    }

    /* Menu Card - Dioptimalkan untuk Tablet/Sentuhan */
    .rm-menu-card {
        background: linear-gradient(145deg, #1A1208, #0F0A05);
        padding: 15px; border-radius: 8px; 
        border: 1px solid rgba(201, 168, 76, 0.2); 
        cursor: pointer; text-align: center; transition: all 0.2s ease-in-out;
        user-select: none; /* Mencegah teks ter-highlight saat di-tap cepat */
    }
    .rm-menu-card:hover, .rm-menu-card:active {
        border-color: #C9A84C; transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(201, 168, 76, 0.15);
    }

    /* Custom Scrollbar */
    #keranjang-list::-webkit-scrollbar { width: 6px; }
    #keranjang-list::-webkit-scrollbar-track { background: rgba(201, 168, 76, 0.05); border-radius: 4px; }
    #keranjang-list::-webkit-scrollbar-thumb { background: rgba(201, 168, 76, 0.4); border-radius: 4px; }

    /* Sihir Responsif untuk Tablet (iPad) dan HP */
    @media (max-width: 992px) {
        .rm-pos-container { flex-direction: column; }
        .rm-pos-menu-area { width: 100%; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); }
        .rm-pos-cart-area { width: 100%; min-width: 100%; position: static; }
    }
</style>

<div class="rm-pos-container">
    
    <div class="rm-pos-menu-area">
        @foreach($menus as $item)
            <div class="rm-menu-card" onclick="tambahKeKeranjang({{ $item->id }}, `{{ $item->nama_menu }}`, {{ $item->harga }})">
                @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 6px; margin-bottom: 12px; border: 1px solid rgba(201, 168, 76, 0.3);">
                @else
                    <div style="width: 100%; height: 120px; background: rgba(255,255,255,0.03); border: 1px dashed rgba(201, 168, 76, 0.4); border-radius: 6px; margin-bottom: 12px; display: flex; align-items: center; justify-content: center; font-size: 11px; color: rgba(201,168,76,0.6); font-family: 'Cinzel', serif;">NO PHOTO</div>
                @endif
                <h4 style="margin: 0 0 8px 0; font-size: 16px; color: #FAF3E0; font-family: 'Playfair Display', serif; line-height: 1.3;">{{ $item->nama_menu }}</h4>
                <span style="color: #E8C97A; font-weight: bold; font-size: 14px; font-family: 'Cinzel', serif;">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
            </div>
        @endforeach
    </div>

    <div class="rm-pos-cart-area">
        <h3 style="margin-top: 0; color: #E8C97A; font-family: 'Playfair Display', serif; font-size: 22px; border-bottom: 1px solid rgba(201, 168, 76, 0.3); padding-bottom: 15px; margin-bottom: 20px;">Detail Pesanan</h3>
        
        <form action="/admin/pos/simpan" method="POST">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px; font-weight: bold; margin-bottom: 8px;">Nama Pelanggan <span style="color:#ff6b6b">*</span></label>
                <input type="text" name="nama_pelanggan" required placeholder="Contoh: Bpk. Budi" class="rm-pos-input">
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 120px;">
                    <label style="display: block; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px; font-weight: bold; margin-bottom: 8px;">Nomor Meja</label>
                    <input type="text" name="nomor_meja" placeholder="Misal: 04" class="rm-pos-input">
                </div>
                <div style="flex: 1; min-width: 150px;">
                    <label style="display: block; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px; font-weight: bold; margin-bottom: 8px;">Pembayaran</label>
                    <select name="metode_pembayaran" class="rm-pos-input">
                        <option value="tunai">Tunai / Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="transfer_bank">Transfer Bank</option>
                    </select>
                </div>
            </div>

            <div id="keranjang-list" style="min-height: 180px; max-height: 350px; overflow-y: auto; margin-bottom: 20px; font-size: 14px; padding-right: 5px;">
                <div style="text-align: center; padding: 40px 0;">
                    <span style="font-size: 40px; opacity: 0.5;">🍽️</span>
                    <p style="color: rgba(250, 243, 224, 0.6); font-style: italic; margin-top: 15px; font-family: 'Cormorant Garamond', serif; font-size: 18px;">Klik menu di kiri untuk menambahkan ke struk.</p>
                </div>
            </div>

            <div style="border-top: 1px solid rgba(201, 168, 76, 0.4); padding-top: 15px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: bold; font-size: 14px; color: #E8C97A; font-family: 'Cinzel', serif; letter-spacing: 2px;">TOTAL</span>
                <span id="total-text" style="font-weight: bold; font-size: 28px; color: #C9A84C; font-family: 'Playfair Display', serif; text-shadow: 0 2px 10px rgba(201, 168, 76, 0.3);">Rp 0</span>
                <input type="hidden" name="total_harga" id="input-total" value="0">
            </div>

            <button type="submit" id="btn-proses" disabled style="width: 100%; padding: 18px; background: transparent; color: rgba(201, 168, 76, 0.4); border: 1px solid rgba(201, 168, 76, 0.4); border-radius: 6px; font-weight: bold; font-size: 16px; font-family: 'Cinzel', serif; letter-spacing: 1.5px; cursor: not-allowed; transition: all 0.3s;">
                PROSES PEMBAYARAN
            </button>
        </form>
    </div>
</div>

<script>
    let keranjang = {};

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function tambahKeKeranjang(id, nama, harga) {
        if(keranjang[id]) {
            keranjang[id].qty += 1;
        } else {
            keranjang[id] = { id: id, nama: nama, harga: harga, qty: 1 };
        }
        renderKeranjang();
    }

    function kurangDariKeranjang(id) {
        if(keranjang[id].qty > 1) {
            keranjang[id].qty -= 1;
        } else {
            delete keranjang[id];
        }
        renderKeranjang();
    }

    function renderKeranjang() {
        const listHTML = document.getElementById('keranjang-list');
        const totalText = document.getElementById('total-text');
        const inputTotal = document.getElementById('input-total');
        const btnProses = document.getElementById('btn-proses');
        
        listHTML.innerHTML = '';
        let total = 0;
        let count = 0;

        for (const key in keranjang) {
            const item = keranjang[key];
            const subtotal = item.qty * item.harga;
            total += subtotal;
            count++;

            listHTML.innerHTML += `
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px dashed rgba(201, 168, 76, 0.3); padding-bottom: 15px;">
                    <div style="flex: 2; padding-right: 10px;">
                        <div style="font-weight: bold; color: #FAF3E0; font-family: 'Nunito Sans', sans-serif; font-size: 15px; line-height: 1.3; margin-bottom: 6px;">${item.nama}</div>
                        <div style="color: #E8C97A; font-size: 13px; font-family: 'Cinzel', serif;">Rp ${formatRupiah(item.harga)}</div>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 12px; flex: 1; justify-content: center;">
                        <button type="button" onclick="kurangDariKeranjang(${item.id})" style="background: rgba(231, 76, 60, 0.1); color: #ff6b6b; border: 1px solid #ff6b6b; border-radius: 6px; cursor: pointer; width: 32px; height: 32px; font-weight: bold; font-size: 16px; transition: 0.2s;">-</button>
                        
                        <span style="font-weight: bold; color: #FAF3E0; width: 20px; text-align: center; font-size: 16px;">${item.qty}</span>
                        
                        <button type="button" onclick="tambahKeKeranjang(${item.id}, \`${item.nama}\`, ${item.harga})" style="background: rgba(201, 168, 76, 0.1); color: #C9A84C; border: 1px solid #C9A84C; border-radius: 6px; cursor: pointer; width: 32px; height: 32px; font-weight: bold; font-size: 16px; transition: 0.2s;">+</button>
                    </div>
                    
                    <div style="flex: 1; text-align: right; font-weight: bold; color: #E8C97A; font-size: 15px; font-family: 'Nunito Sans', sans-serif;">
                        Rp ${formatRupiah(subtotal)}
                    </div>
                    
                    <input type="hidden" name="menu_id[]" value="${item.id}">
                    <input type="hidden" name="qty[]" value="${item.qty}">
                    <input type="hidden" name="harga_satuan[]" value="${item.harga}">
                </div>
            `;
        }

        if (count === 0) {
            listHTML.innerHTML = `
                <div style="text-align: center; padding: 40px 0;">
                    <span style="font-size: 40px; opacity: 0.5;">🍽️</span>
                    <p style="color: rgba(250, 243, 224, 0.6); font-style: italic; margin-top: 15px; font-family: 'Cormorant Garamond', serif; font-size: 18px;">Keranjang masih kosong.</p>
                </div>
            `;
            
            btnProses.style.background = 'transparent';
            btnProses.style.color = 'rgba(201, 168, 76, 0.4)';
            btnProses.style.border = '1px solid rgba(201, 168, 76, 0.4)';
            btnProses.style.cursor = 'not-allowed';
            btnProses.disabled = true;
        } else {
            btnProses.style.background = 'linear-gradient(135deg, #8B6914, #C9A84C)';
            btnProses.style.color = '#0A0805';
            btnProses.style.border = 'none';
            btnProses.style.boxShadow = '0 6px 20px rgba(201,168,76,0.3)';
            btnProses.style.cursor = 'pointer';
            btnProses.disabled = false;
        }

        totalText.innerText = 'Rp ' + formatRupiah(total);
        inputTotal.value = total;
    }
</script>
@endsection
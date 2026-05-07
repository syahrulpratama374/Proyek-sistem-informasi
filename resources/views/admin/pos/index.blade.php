@extends('admin.layouts.app')

@section('title', 'POS Kasir - Ratu Minang')
@section('header_title', 'Point of Sale (Mesin Kasir)')

@section('content')
<style>
    /* Styling khusus input untuk mode gelap Ratu Minang */
    .rm-pos-input { 
        width: 100%; padding: 12px 15px; 
        background: rgba(255, 255, 255, 0.03); 
        border: 1px solid rgba(201, 168, 76, 0.3); 
        border-radius: 4px; color: #FAF3E0; 
        font-family: 'Nunito Sans', sans-serif; box-sizing: border-box; transition: 0.3s; 
    }
    .rm-pos-input:focus { outline: none; border-color: #C9A84C; background: rgba(201, 168, 76, 0.08); }
    .rm-pos-input::placeholder { color: rgba(250, 243, 224, 0.3); }
    select.rm-pos-input option { background: #0A0805; color: #FAF3E0; }
    
    /* Custom Scrollbar untuk area keranjang jika pesanan banyak */
    #keranjang-list::-webkit-scrollbar { width: 6px; }
    #keranjang-list::-webkit-scrollbar-track { background: rgba(201, 168, 76, 0.05); border-radius: 4px; }
    #keranjang-list::-webkit-scrollbar-thumb { background: rgba(201, 168, 76, 0.3); border-radius: 4px; }
    #keranjang-list::-webkit-scrollbar-thumb:hover { background: rgba(201, 168, 76, 0.6); }
</style>

<div style="display: flex; gap: 20px; flex-wrap: wrap;">
    
    <!-- AREA MENU KIRI -->
    <div style="flex: 2; min-width: 60%;">
        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            @foreach($menus as $item)
                <!-- PEMICU JAVASCRIPT ADA DI SINI -->
                <div onclick="tambahKeKeranjang({{ $item->id }}, `{{ $item->nama_menu }}`, {{ $item->harga }})" 
                     style="background: linear-gradient(145deg, #1A1208, #0F0A05); width: calc(33.3% - 15px); min-width: 160px; padding: 15px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); cursor: pointer; text-align: center; border: 1px solid rgba(201, 168, 76, 0.15); transition: all 0.3s;"
                     onmouseover="this.style.borderColor='#C9A84C'; this.style.transform='translateY(-3px)';" 
                     onmouseout="this.style.borderColor='rgba(201, 168, 76, 0.15)'; this.style.transform='translateY(0)';">
                    
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" style="width: 100%; height: 110px; object-fit: cover; border-radius: 4px; margin-bottom: 12px; border: 1px solid rgba(201, 168, 76, 0.2);">
                    @else
                        <div style="width: 100%; height: 110px; background: rgba(255,255,255,0.02); border: 1px dashed rgba(201, 168, 76, 0.3); border-radius: 4px; margin-bottom: 12px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: rgba(201,168,76,0.5); font-family: 'Cinzel', serif;">TIDAK ADA FOTO</div>
                    @endif
                    
                    <h4 style="margin: 0 0 8px 0; font-size: 15px; color: #FAF3E0; font-family: 'Playfair Display', serif;">{{ $item->nama_menu }}</h4>
                    <span style="color: #C9A84C; font-weight: bold; font-size: 14px; font-family: 'Cinzel', serif;">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- AREA KERANJANG KANAN -->
    <div style="flex: 1; min-width: 320px; background: #0A0805; padding: 25px; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.6); border: 1px solid rgba(201, 168, 76, 0.2); height: fit-content; position: sticky; top: 20px;">
        <h3 style="margin-top: 0; color: #E8C97A; font-family: 'Playfair Display', serif; font-size: 22px; border-bottom: 1px solid rgba(201, 168, 76, 0.2); padding-bottom: 15px; margin-bottom: 20px;">Detail Pesanan</h3>
        
        <form action="/admin/pos/simpan" method="POST">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 11px; letter-spacing: 1px; font-weight: bold; margin-bottom: 8px;">Nama Pelanggan <span style="color:#ff6b6b">*</span></label>
                <input type="text" name="nama_pelanggan" required placeholder="Contoh: Bpk. Budi" class="rm-pos-input">
            </div>

            <div style="display: flex; gap: 15px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label style="display: block; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 11px; letter-spacing: 1px; font-weight: bold; margin-bottom: 8px;">Nomor Meja</label>
                    <input type="text" name="nomor_meja" placeholder="Misal: 04" class="rm-pos-input">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; color: #E8C97A; font-family: 'Cinzel', serif; font-size: 11px; letter-spacing: 1px; font-weight: bold; margin-bottom: 8px;">Pembayaran</label>
                    <select name="metode_pembayaran" class="rm-pos-input">
                        <option value="tunai">Tunai / Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="transfer_bank">Transfer Bank</option>
                    </select>
                </div>
            </div>

            <!-- AREA MUNCULNYA DAFTAR MENU -->
            <div id="keranjang-list" style="min-height: 150px; max-height: 300px; overflow-y: auto; margin-bottom: 20px; font-size: 14px; padding-right: 5px;">
                <p style="text-align: center; color: rgba(250, 243, 224, 0.3); font-style: italic; margin-top: 40px; font-family: 'Cormorant Garamond', serif; font-size: 16px;">Klik menu di sebelah kiri untuk menambahkan ke struk.</p>
            </div>

            <div style="border-top: 1px solid rgba(201, 168, 76, 0.3); padding-top: 15px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: bold; font-size: 14px; color: #E8C97A; font-family: 'Cinzel', serif; letter-spacing: 2px;">TOTAL BELANJA</span>
                <span id="total-text" style="font-weight: bold; font-size: 26px; color: #C9A84C; font-family: 'Playfair Display', serif; text-shadow: 0 2px 10px rgba(201, 168, 76, 0.2);">Rp 0</span>
                <input type="hidden" name="total_harga" id="input-total" value="0">
            </div>

            <button type="submit" id="btn-proses" disabled style="width: 100%; padding: 15px; background: transparent; color: rgba(201, 168, 76, 0.3); border: 1px solid rgba(201, 168, 76, 0.3); border-radius: 4px; font-weight: bold; font-size: 14px; font-family: 'Cinzel', serif; letter-spacing: 1.5px; cursor: not-allowed; transition: all 0.3s;">
                PROSES PEMBAYARAN
            </button>
        </form>
    </div>
</div>

<!-- 🌟 JAVASCRIPT KASIR (WAJIB DISALIN) 🌟 -->
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
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; border-bottom: 1px dashed rgba(201, 168, 76, 0.2); padding-bottom: 12px;">
                    <div style="flex: 2; padding-right: 10px;">
                        <div style="font-weight: bold; color: #FAF3E0; font-family: 'Nunito Sans', sans-serif; line-height: 1.2; margin-bottom: 4px;">${item.nama}</div>
                        <div style="color: rgba(201, 168, 76, 0.8); font-size: 11px; font-family: 'Cinzel', serif;">Rp ${formatRupiah(item.harga)}</div>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 10px; flex: 1; justify-content: center;">
                        <button type="button" onclick="kurangDariKeranjang(${item.id})" style="background: transparent; color: #ff6b6b; border: 1px solid #8B1A1A; border-radius: 4px; cursor: pointer; width: 24px; height: 24px; font-weight: bold; transition: 0.2s;">-</button>
                        
                        <span style="font-weight: bold; color: #FAF3E0; width: 15px; text-align: center;">${item.qty}</span>
                        
                        <button type="button" onclick="tambahKeKeranjang(${item.id}, \`${item.nama}\`, ${item.harga})" style="background: transparent; color: #C9A84C; border: 1px solid #C9A84C; border-radius: 4px; cursor: pointer; width: 24px; height: 24px; font-weight: bold; transition: 0.2s;">+</button>
                    </div>
                    
                    <div style="flex: 1; text-align: right; font-weight: bold; color: #E8C97A; font-family: 'Nunito Sans', sans-serif;">
                        Rp ${formatRupiah(subtotal)}
                    </div>
                    
                    <!-- INPUT TERSEMBUNYI UNTUK DIKIRIM KE CONTROLLER -->
                    <input type="hidden" name="menu_id[]" value="${item.id}">
                    <input type="hidden" name="qty[]" value="${item.qty}">
                    <input type="hidden" name="harga_satuan[]" value="${item.harga}">
                </div>
            `;
        }

        if (count === 0) {
            listHTML.innerHTML = `<p style="text-align: center; color: rgba(250, 243, 224, 0.3); font-style: italic; margin-top: 40px; font-family: 'Cormorant Garamond', serif; font-size: 16px;">Keranjang kosong.</p>`;
            
            btnProses.style.background = 'transparent';
            btnProses.style.color = 'rgba(201, 168, 76, 0.3)';
            btnProses.style.border = '1px solid rgba(201, 168, 76, 0.3)';
            btnProses.style.cursor = 'not-allowed';
            btnProses.disabled = true;
        } else {
            btnProses.style.background = 'linear-gradient(135deg, #8B6914, #C9A84C)';
            btnProses.style.color = '#0A0805';
            btnProses.style.border = 'none';
            btnProses.style.cursor = 'pointer';
            btnProses.disabled = false;
        }

        totalText.innerText = 'Rp ' + formatRupiah(total);
        inputTotal.value = total;
    }
</script>
@endsection
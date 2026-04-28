@extends('admin.layouts.app')

@section('title', 'POS Kasir - Ratu Minang')
@section('header_title', 'Point of Sale (Kasir)')

@section('content')
<div style="display: flex; gap: 20px; flex-wrap: wrap;">
    
    <div style="flex: 2; min-width: 60%;">
        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            @foreach($menus as $item)
                <div onclick="tambahKeKeranjang({{ $item->id }}, '{{ $item->nama_menu }}', {{ $item->harga }})" 
                     style="background: white; width: calc(33.3% - 15px); min-width: 150px; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); cursor: pointer; text-align: center; border: 2px solid transparent; transition: 0.2s;"
                     onmouseover="this.style.borderColor='#e74c3c'" onmouseout="this.style.borderColor='transparent'">
                    
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}" style="width: 100%; height: 100px; object-fit: cover; border-radius: 4px; margin-bottom: 10px;">
                    @else
                        <div style="width: 100%; height: 100px; background: #eee; border-radius: 4px; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #888;">No Foto</div>
                    @endif
                    
                    <h4 style="margin: 0 0 5px 0; font-size: 14px; color: #333;">{{ $item->nama_menu }}</h4>
                    <span style="color: #27ae60; font-weight: bold; font-size: 14px;">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div style="flex: 1; min-width: 300px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); height: fit-content; position: sticky; top: 20px;">
        <h3 style="margin-top: 0; color: #333; border-bottom: 2px dashed #ddd; padding-bottom: 15px;">Detail Pesanan</h3>
        
        <form action="/admin/pos/simpan" method="POST">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px;">Nama Pelanggan (Offline) <span style="color:red">*</span></label>
                <input type="text" name="nama_pelanggan" required placeholder="Contoh: Budi" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div style="display: flex; gap: 10px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px;">Nomor Meja</label>
                    <input type="text" name="nomor_meja" placeholder="Misal: 04" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-weight: bold; margin-bottom: 5px; font-size: 13px;">Pembayaran</label>
                    <select name="metode_pembayaran" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;">
                        <option value="tunai">Tunai / Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="transfer_bank">Transfer Bank</option>
                        <!-- <option value="kartu_debit">Kartu Debit</option>
                        <option value="kartu_kredit">Kartu Kredit</option> -->
                    </select>
                </div>
            </div>

            <div id="keranjang-list" style="min-height: 100px; margin-bottom: 20px; font-size: 14px;">
                <p style="text-align: center; color: #888; font-style: italic;">Klik menu di sebelah kiri untuk menambahkan ke struk.</p>
            </div>

            <div style="border-top: 2px solid #333; padding-top: 15px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: bold; font-size: 18px;">TOTAL</span>
                <span id="total-text" style="font-weight: bold; font-size: 22px; color: #e74c3c;">Rp 0</span>
                <input type="hidden" name="total_harga" id="input-total" value="0">
            </div>

            <button type="submit" id="btn-proses" disabled style="width: 100%; padding: 15px; background: #6c757d; color: white; border: none; border-radius: 4px; font-weight: bold; font-size: 16px; cursor: not-allowed;">
                Proses Pembayaran
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

            // Membuat baris item + input hidden untuk dikirim ke Controller
            listHTML.innerHTML += `
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                    <div style="flex: 2;">
                        <span style="font-weight: bold;">${item.nama}</span><br>
                        <span style="color: #666; font-size: 12px;">Rp ${formatRupiah(item.harga)}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; flex: 1;">
                        <button type="button" onclick="kurangDariKeranjang(${item.id})" style="background: #e74c3c; color: white; border: none; border-radius: 3px; cursor: pointer; width: 22px; height: 22px;">-</button>
                        <span style="font-weight: bold;">${item.qty}</span>
                        <button type="button" onclick="tambahKeKeranjang(${item.id}, '${item.nama}', ${item.harga})" style="background: #27ae60; color: white; border: none; border-radius: 3px; cursor: pointer; width: 22px; height: 22px;">+</button>
                    </div>
                    <div style="flex: 1; text-align: right; font-weight: bold; color: #333;">
                        Rp ${formatRupiah(subtotal)}
                    </div>
                    <input type="hidden" name="menu_id[]" value="${item.id}">
                    <input type="hidden" name="qty[]" value="${item.qty}">
                    <input type="hidden" name="harga_satuan[]" value="${item.harga}">
                </div>
            `;
        }

        if (count === 0) {
            listHTML.innerHTML = '<p style="text-align: center; color: #888; font-style: italic;">Keranjang kosong.</p>';
            btnProses.style.background = '#6c757d';
            btnProses.style.cursor = 'not-allowed';
            btnProses.disabled = true;
        } else {
            btnProses.style.background = '#e74c3c';
            btnProses.style.cursor = 'pointer';
            btnProses.disabled = false;
        }

        totalText.innerText = 'Rp ' + formatRupiah(total);
        inputTotal.value = total;
    }
</script>
@endsection         
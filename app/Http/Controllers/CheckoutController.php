<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth;
use Midtrans\Config; 
use Midtrans\Snap;   

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk checkout.');
        }

        $keranjang = session('keranjang', []);
        return view('checkout.index', compact('keranjang'));
    }

    public function proses(Request $request) 
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu untuk checkout.');
        }

        $request->validate([
            'nomor_meja' => ['required', 'string'],
            'metode_pembayaran' => ['required', 'in:tunai,transfer,transfer_bank,qris'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ]);

        $keranjang = session('keranjang', []);

        if (empty($keranjang)) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        try {
            $pesananBaru = DB::transaction(function () use ($request, $keranjang) {
                
                $total = collect($keranjang)->sum(fn($item) => $item['harga'] * $item['qty']);

                $pesanan = Pesanan::create([
                    'user_id'           => Auth::id(),
                    'kode_pesanan'      => 'PSN-' . strtoupper(Str::random(8)),
                    'nomor_meja'        => $request->nomor_meja,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'total_harga'       => $total,
                    'catatan'           => $request->catatan,
                    'status'            => 'pending',
                ]);

                foreach ($keranjang as $menuId => $item) {
                    $pesanan->detailPesanans()->create([
                        'menu_id'      => $menuId,
                        'qty'          => $item['qty'],
                        'harga_satuan' => $item['harga'],
                    ]);
                }
                
                return $pesanan;
            });

            // 🌟 LOGIKA MIDTRANS 🌟
            if (in_array($request->metode_pembayaran, ['qris', 'transfer', 'transfer_bank'])) {
                
                // MENGAMBIL KUNCI RAHASIA DARI FILE .ENV (SANGAT AMAN)
                Config::$serverKey = env('MIDTRANS_SERVER_KEY'); 
                Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false); 
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $params = array(
                    'transaction_details' => array(
                        'order_id' => $pesananBaru->kode_pesanan,
                        'gross_amount' => $pesananBaru->total_harga,
                    ),
                    'customer_details' => array(
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email ?? 'pelanggan@example.com',
                    ),
                );

                $snapToken = Snap::getSnapToken($params);

                session()->forget('keranjang');
                
                return view('checkout.bayar', compact('snapToken', 'pesananBaru'));
            }

            // JIKA TUNAI
            session()->forget('keranjang');
            return redirect('/checkout/sukses')->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            return back()->with('error', 'Sistem Pembayaran Gagal: ' . $e->getMessage());
        }
    }

    // 🌟 FUNGSI SUKSES YANG SUDAH DITINGKATKAN 🌟
    public function sukses(Request $request)
    {
        // Mengecek apakah pembayaran online sukses dan mengirimkan order_id
        if ($request->has('order_id')) {
            // Ubah otomatis statusnya jadi 'diproses'
            Pesanan::where('kode_pesanan', $request->order_id)
                   ->where('status', 'pending')
                   ->update(['status' => 'diproses']);
        }

        return view('checkout.sukses');
    }
}
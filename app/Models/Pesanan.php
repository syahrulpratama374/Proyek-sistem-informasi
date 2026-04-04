<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'metode_pembayaran',
        'total_harga',
        'status'
    ];

  
    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
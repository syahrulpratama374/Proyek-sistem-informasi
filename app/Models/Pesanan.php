<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Pesanan extends Model {
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'kode_pesanan', 'total_harga',
        'status', 'catatan', 
        'nomor_meja',          
        'metode_pembayaran',   
    ];

    protected $casts = [
        'total_harga' => 'integer',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }


    public function detailPesanans() {
        return $this->hasMany(DetailPesanan::class);
    }

    // Scope: Pesanan::selesai()->get()
    public function scopeSelesai($q) {
        return $q->where('status', 'selesai');
    }

    public function getTotalRupiahAttribute(): string {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
    use HasFactory;

// Sesuaikan dengan nama kolom di migration
    protected $fillable = [
        'nama_menu', 'deskripsi', 'harga', 
        'kategori', 'foto', 'tersedia',
    ]; // Saya hapus 'stok' karena di migration tidak ada. Kalau mau pakai stok, tambahkan dulu di migration ya.

    protected $casts = [
        'harga'    => 'integer',
        'tersedia' => 'boolean',
    ];

    // Scope juga perlu disesuaikan kalau kolom stok dihapus
    public function scopeTersedia($query) {
        return $query->where('tersedia', true);
    }

    // Helper format Rupiah: {{ $menu->harga_rupiah }}
    public function getHargaRupiahAttribute(): string {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function detailPesanans() {
        return $this->hasMany(DetailPesanan::class);
    }
}
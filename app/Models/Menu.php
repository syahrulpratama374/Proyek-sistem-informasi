<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 🌟 Import SoftDeletes

class Menu extends Model {
    
    use HasFactory, SoftDeletes; // 🌟 Penulisan yang benar dipisah dengan koma

    // 🌟 Disatukan agar tidak tumpang tindih
    protected $fillable = [
        'nama_menu', 
        'deskripsi', 
        'harga', 
        'kategori', 
        'foto', 
        'tersedia'
    ]; 

    protected $casts = [
        'harga'    => 'integer',
        'tersedia' => 'boolean',
    ];

    // Scope untuk memfilter menu yang tersedia
    public function scopeTersedia($query) {
        return $query->where('tersedia', true);
    }

    // Helper format Rupiah: {{ $menu->harga_rupiah }}
    public function getHargaRupiahAttribute(): string {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    // Relasi ke tabel detail pesanan
    public function detailPesanans() {
        return $this->hasMany(DetailPesanan::class);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['nama_menu' => 'Rendang Daging', 'kategori' => 'Lauk Utama', 'harga' => 22000, 'deskripsi' => 'Daging sapi empuk yang dimasak perlahan dengan santan dan rempah rahasia khas Minang.', 'tersedia' => true],
            ['nama_menu' => 'Ayam Pop', 'kategori' => 'Lauk Utama', 'harga' => 18000, 'deskripsi' => 'Ayam kampung rebus gurih khas Bukittinggi, disajikan lengkap dengan saus sambal tomat khusus.', 'tersedia' => true],
            ['nama_menu' => 'Dendeng Batokok', 'kategori' => 'Lauk Utama', 'harga' => 20000, 'deskripsi' => 'Daging sapi iris tipis yang dipukul-pukul (batokok) agar bumbu meresap, disiram lado mudo (sambal ijo).', 'tersedia' => true],
            ['nama_menu' => 'Gulai Tunjang (Kikil)', 'kategori' => 'Lauk Utama', 'harga' => 25000, 'deskripsi' => 'Kikil sapi kenyal yang dimasak dalam kuah gulai kental nan gurih.', 'tersedia' => true],
            ['nama_menu' => 'Gulai Cumi', 'kategori' => 'Lauk Utama', 'harga' => 28000, 'deskripsi' => 'Cumi segar isi tahu telur yang dimasak bumbu gulai kuning.', 'tersedia' => true],
            ['nama_menu' => 'Sayur Nangka (Gulai Cubadak)', 'kategori' => 'Sayuran', 'harga' => 10000, 'deskripsi' => 'Gulai nangka muda dengan bumbu rempah dan kuah santan.', 'tersedia' => true],
            ['nama_menu' => 'Daun Singkong Rebus', 'kategori' => 'Sayuran', 'harga' => 5000, 'deskripsi' => 'Rebusan daun singkong segar, pelengkap wajib makan nasi Padang.', 'tersedia' => true],
            ['nama_menu' => 'Nasi Putih', 'kategori' => 'Nasi & Karbohidrat', 'harga' => 6000, 'deskripsi' => 'Nasi putih hangat dengan porsi pas.', 'tersedia' => true],
            ['nama_menu' => 'Es Teh Manis', 'kategori' => 'Minuman', 'harga' => 5000, 'deskripsi' => 'Teh manis dingin pelepas dahaga.', 'tersedia' => true],
            ['nama_menu' => 'Es Jeruk Peras', 'kategori' => 'Minuman', 'harga' => 10000, 'deskripsi' => 'Perasan jeruk segar asli tanpa pemanis buatan.', 'tersedia' => true],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'nama_menu' => 'Rendang Daging',
                'deskripsi' => 'Daging sapi pilihan dengan bumbu rendang asli Minang.',
                'harga' => 25000,
                'kategori' => 'Makanan',
                'tersedia' => true,
            ],
            [
                'nama_menu' => 'Ayam Pop',
                'deskripsi' => 'Ayam kampung gurih dengan sambal khas.',
                'harga' => 20000,
                'kategori' => 'Makanan',
                'tersedia' => true,
            ],
            [
                'nama_menu' => 'Es Teh Manis',
                'deskripsi' => 'Segar dan manis.',
                'harga' => 5000,
                'kategori' => 'Minuman',
                'tersedia' => true,
            ],
        ]);
    }
}
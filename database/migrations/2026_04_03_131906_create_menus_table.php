<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('nama_menu');
        $table->text('deskripsi')->nullable();
        $table->integer('harga');
        $table->string('kategori')->default('Makanan'); // Misalnya: Makanan, Minuman, Snack
        $table->string('foto')->nullable(); // Untuk nama file gambar
        $table->boolean('tersedia')->default(true); // Status stok: true (ada) atau false (habis)
        $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};

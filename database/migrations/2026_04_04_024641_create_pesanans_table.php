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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('kode_pesanan')->unique();
            
            // Tambahan berdasarkan wireframe
            $table->string('nomor_meja')->nullable(); 
            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'qris'])->default('tunai');
            
            $table->enum('status', ['pending', 'diproses', 'selesai', 'batal'])->default('pending');
            $table->unsignedBigInteger('total_harga')->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'created_at']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};

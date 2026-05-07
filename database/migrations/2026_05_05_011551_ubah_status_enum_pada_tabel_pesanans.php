<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan perubahan (Menambahkan 'diantar')
     */
    public function up(): void
    {
        // Menggunakan Raw SQL adalah cara paling aman untuk mengubah ENUM di Laravel
        DB::statement("ALTER TABLE pesanans MODIFY COLUMN status ENUM('pending', 'diproses', 'diantar', 'selesai', 'batal') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Kembalikan seperti semula jika di-rollback (Menghapus 'diantar')
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE pesanans MODIFY COLUMN status ENUM('pending', 'diproses', 'selesai', 'batal') NOT NULL DEFAULT 'pending'");
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
    // 1) Pastikan ada index terpisah untuk FK
    Schema::table('pengajuans', function (Blueprint $table) {
        // Tambah index kalau belum ada (try-catch biar idempotent)
        try { $table->index('spbu_id', 'idx_pengajuans_spbu_id'); } catch (\Throwable $e) {}
        try { $table->index('product_id', 'idx_pengajuans_product_id'); } catch (\Throwable $e) {}
    });

    // 2) Coba drop unique lama kalau ada (yang bikin bentrok saat approve)
    try {
        DB::statement("DROP INDEX `uniq_pengajuan_pending` ON `pengajuans`");
    } catch (\Throwable $e) {
        // Abaikan kalau tidak ada / lagi dipakai FK tapi sudah punya index terpisah
        // (kalau tetap gagal, berarti namanya beda — aman di-skip)
    }

    // 3) Tambah generated column is_pending (STORED) kalau belum ada
    if (! Schema::hasColumn('pengajuans', 'is_pending')) {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->unsignedTinyInteger('is_pending')
                ->storedAs("CASE WHEN status = 'pending' THEN 1 ELSE 0 END");
        });
    }

    // 4) Unique baru: hanya “mengikat” baris pending
    //    (spbu_id, product_id, is_pending) → hanya boleh satu pending per kombinasi.
    try {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->unique(['spbu_id', 'product_id', 'is_pending'], 'uniq_pengajuan_pending_only');
        });
    } catch (\Throwable $e) {
        // abaikan jika sudah ada
    }
}


    public function down(): void
    {
        // Balikkan perubahan dengan aman
        if (Schema::hasColumn('pengajuans', 'is_pending')) {
            Schema::table('pengajuans', function (Blueprint $table) {
                // Drop unique baru kalau ada
                try {
                    $table->dropUnique('uniq_pengajuan_pending_only');
                } catch (\Throwable $e) {
                    // diamkan kalau memang sudah tidak ada
                }
                $table->dropColumn('is_pending');
            });
        }

        // (Opsional) Jika dulu kamu memang punya unique lama dan ingin mengembalikannya:
        // Schema::table('pengajuans', function (Blueprint $table) {
        //     $table->unique(['spbu_id','product_id','status'], 'uniq_pengajuan_pending');
        // });
    }
};

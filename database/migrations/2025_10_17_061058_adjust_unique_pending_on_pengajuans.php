<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1) Tambah kolom generated "is_pending" kalau belum ada
        if (! Schema::hasColumn('pengajuans', 'is_pending')) {
            DB::statement("
                ALTER TABLE pengajuans
                ADD COLUMN is_pending TINYINT(1) AS (CASE WHEN status = 'pending' THEN 1 ELSE 0 END) STORED
            ");
        }

        // 2) Drop index lama kalau ada
        //    (abaikan error jika tidak ada)
        try {
            Schema::table('pengajuans', function (Blueprint $table) {
                $table->dropIndex('uniq_pengajuan_pending_only');
            });
        } catch (\Throwable $e) {}

        // 3) Buat unique index baru: per user
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->unique(
                ['product_id', 'spbu_id', 'created_by', 'is_pending'],
                'uniq_pengajuan_pending_per_user'
            );
        });
    }

    public function down(): void
    {
        // Rollback: balikin seperti semula (kalau perlu)
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropUnique('uniq_pengajuan_pending_per_user');
        });

        // (Opsional) kembalikan index lama:
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->unique(
                ['product_id', 'spbu_id', 'is_pending'],
                'uniq_pengajuan_pending_only'
            );
        });

        // (Tidak wajib) hapus kolom is_pending:
        // DB::statement("ALTER TABLE pengajuans DROP COLUMN is_pending");
    }
};

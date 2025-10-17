<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // TOKOS.user_id => ON DELETE CASCADE (hapus toko saat user dihapus)
        Schema::table('tokos', function (Blueprint $table) {
            // 1) Drop FK lama
            $table->dropForeign(['user_id']);

            // 2) Pastikan kolom sesuai (biasanya unsigned bigInt)
            // $table->unsignedBigInteger('user_id')->change(); // aktifkan jika butuh

            // 3) Buat FK baru dengan cascade
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });

        // PRODUKS.user_id => SET NULL (histori produk tetap ada, pemilik dikosongkan)
        Schema::table('produks', function (Blueprint $table) {
            // kalau kolom belum nullable, ubah dulu:
            $table->unsignedBigInteger('user_id')->nullable()->change();

            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
        });

        // PENGAJUANS.created_by & approved_by => SET NULL (histori tetap ada)
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable()->change();
            $table->unsignedBigInteger('approved_by')->nullable()->change();

            $table->dropForeign(['created_by']);
            $table->dropForeign(['approved_by']);

            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('approved_by')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        // OPTIONAL: kembalikan seperti semula (kalau tahu definisi awalnya)
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spbus', function (Blueprint $table) {
            $table->id(); // id
            $table->string('nomor_spbu')->unique();   // Nomor SPBU
            $table->string('tipe')();   // Tipe SPBU (internal/eksternal)
            $table->string('alamat')->nullable();     // Alamat
            $table->string('kecamatan')->nullable();  // kecamatan
            $table->string('kelurahan')->nullable();  // Kelurahan
            $table->string('kota')->nullable();       // Kota
            $table->unsignedInteger('potensi_konsumen')->nullable(); // Potensi Konsumen
            $table->unsignedInteger('margin')->nullable(); // Sharing margin
            $table->unsignedInteger('slot')->default(0);             // Slot
            $table->string('foto')->nullable();
            $table->timestamps();
            // kalau ingin bisa dihapus lembut, aktifkan:
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spbus');
    }
};

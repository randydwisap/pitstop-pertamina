<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('picture')->nullable();                         // path gambar (string, bukan JSON)
            $table->string('nama_produk');                                 // nama
            $table->decimal('harga_jual', 15, 2)->default(0);              // harga
            $table->string('jenis_produk')->nullable();                    // jenis
            $table->unsignedInteger('ekspektasi_penjualan')->nullable();   // ekspektasi / bulan
            $table->boolean('is_active')->default(true);                   // aktif?
            $table->foreignId('toko_id')->constrained('tokos')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};

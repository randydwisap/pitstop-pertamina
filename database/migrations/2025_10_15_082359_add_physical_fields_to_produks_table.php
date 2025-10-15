<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->unsignedInteger('berat_gram')->nullable()->after('picture');
            $table->unsignedSmallInteger('panjang_cm')->nullable()->after('berat_gram');
            $table->unsignedSmallInteger('lebar_cm')->nullable()->after('panjang_cm');
            $table->unsignedSmallInteger('tinggi_cm')->nullable()->after('lebar_cm');

            $table->unsignedInteger('kadaluarsa_nilai')->nullable()->after('tinggi_cm');
            $table->enum('kadaluarsa_satuan', ['jam','hari','bulan'])->nullable()->after('kadaluarsa_nilai');
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn([
                'berat_gram', 'panjang_cm', 'lebar_cm', 'tinggi_cm',
                'kadaluarsa_nilai', 'kadaluarsa_satuan',
            ]);
        });
    }
};

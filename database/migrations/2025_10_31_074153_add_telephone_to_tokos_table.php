<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tokos', function (Blueprint $table) {
            $table->string('telephone', 20)
                  ->nullable()
                  ->after('alamat_toko'); // posisi setelah kolom alamat_toko
        });
    }

    public function down(): void
    {
        Schema::table('tokos', function (Blueprint $table) {
            $table->dropColumn('telephone');
        });
    }
};

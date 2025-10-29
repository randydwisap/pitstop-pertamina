<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spbus', function (Blueprint $table) {
            $table->string('nama_pic', 100)->nullable()->after('margin');
            $table->string('nomor_pic', 20)->nullable()->after('nama_pic');
        });
    }

    public function down(): void
    {
        Schema::table('spbus', function (Blueprint $table) {
            $table->dropColumn(['nama_pic', 'nomor_pic']);
        });
    }
};


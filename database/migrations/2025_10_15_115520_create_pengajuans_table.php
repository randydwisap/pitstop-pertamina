<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('produks')->cascadeOnDelete();
            $table->foreignId('spbu_id')->constrained('spbus')->cascadeOnDelete();
            $table->enum('status', ['pending', 'approved'])->default('pending');

            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();

            $table->unsignedInteger('quantity')->default(1);
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // cegah dobel pending (opsional)
            $table->unique(['product_id', 'spbu_id', 'status'], 'uniq_pengajuan_pending')
                ->where('status', 'pending');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};

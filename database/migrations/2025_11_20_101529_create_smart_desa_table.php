<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('smart_desa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_permohonan_id')->nullable()->constrained('surat_permohonan')->nullOnDelete();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->cascadeOnDelete();
            $table->foreignId('desa_kelurahan_id')->constrained('desa_kelurahan')->cascadeOnDelete();
            $table->string('alamat');
            $table->string('status_desa')->default('Menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_desa');
    }
};

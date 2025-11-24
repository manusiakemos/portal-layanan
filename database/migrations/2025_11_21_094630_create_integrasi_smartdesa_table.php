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
        Schema::create('integrasi_smartdesa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_permohonan_id')->nullable()->constrained('surat_permohonan')->nullOnDelete();
            $table->foreignId('smart_desa_id')->nullable()->constrained('smart_desa')->nullOnDelete();            
            $table->string('status_aktif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrasi_smartdesa');
    }
};

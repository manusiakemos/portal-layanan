<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('kode_kecamatan')->unique();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Insert data kecamatan Kabupaten Tabalong
        DB::table('kecamatan')->insert([
            ['nama' => 'Banua Lawas',   'kode_kecamatan' => '63.09.01', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kelua',         'kode_kecamatan' => '63.09.02', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Tanta',         'kode_kecamatan' => '63.09.03', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Tanjung',       'kode_kecamatan' => '63.09.04', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Haruai',        'kode_kecamatan' => '63.09.05', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Murung Pudak',  'kode_kecamatan' => '63.09.06', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Muara Uya',     'kode_kecamatan' => '63.09.07', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Muara Harus',   'kode_kecamatan' => '63.09.08', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pugaan',        'kode_kecamatan' => '63.09.09', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Upau',          'kode_kecamatan' => '63.09.10', 'created_at' => now(), 'updated_at' => now()],            
            ['nama' => 'Jaro',          'kode_kecamatan' => '63.09.11', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bintang Ara',   'kode_kecamatan' => '63.09.12', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatan');
    }
};
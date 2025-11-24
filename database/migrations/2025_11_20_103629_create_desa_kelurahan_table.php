<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('desa_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->cascadeOnDelete();
            $table->string('nama');
            $table->enum('jenis', ['Desa', 'Kelurahan']);            
            $table->string('kode_pos');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        // Ambil ID kecamatan
        $kec = DB::table('kecamatan')->pluck('id', 'nama')->toArray();

        /**
         * ============================
         * DATA DESA / KELURAHAN + KODE POS
         * ============================
         */
        $data = [

            // =======================
            // BANUA LAWAS – 71553
            // =======================
            ['Banua Lawas', 'Banua Lawas', 'Desa', '71553'],
            ['Banua Lawas', 'Bangkiling', 'Desa', '71553'],
            ['Banua Lawas', 'Bangkiling Raya', 'Desa', '71553'],
            ['Banua Lawas', 'Banua Rantau', 'Desa', '71553'],
            ['Banua Lawas', 'Batang Banyu', 'Desa', '71553'],
            ['Banua Lawas', 'Bungin', 'Desa', '71553'],
            ['Banua Lawas', 'Habau', 'Desa', '71553'],
            ['Banua Lawas', 'Habau Hulu', 'Desa', '71553'],
            ['Banua Lawas', 'Hapalah', 'Desa', '71553'],
            ['Banua Lawas', 'Hariang', 'Desa', '71553'],
            ['Banua Lawas', 'Pematang', 'Desa', '71553'],
            ['Banua Lawas', 'Purai', 'Desa', '71553'],
            ['Banua Lawas', 'Sungai Anyar', 'Desa', '71553'],
            ['Banua Lawas', 'Sungai Durian', 'Desa', '71567'],
            ['Banua Lawas', 'Talan', 'Desa', '71553'],

            // =======================
            // KELUA – 71552
            // =======================
            ['Kelua', 'Ampukung', 'Desa', '71552'],
            ['Kelua', 'Bahungin', 'Desa', '71552'],
            ['Kelua', 'Binturu', 'Desa', '71552'],
            ['Kelua', 'Karangan Putih', 'Desa', '71552'],
            ['Kelua', 'Masintan', 'Desa', '71552'],
            ['Kelua', 'Paliat', 'Desa', '71552'],
            ['Kelua', 'Pasar Panas', 'Desa', '71552'],
            ['Kelua', 'Pudak Setegal', 'Desa', '71552'],
            ['Kelua', 'Sungai Buluh', 'Desa', '71552'],
            ['Kelua', 'Takulat', 'Desa', '71552'],
            ['Kelua', 'Telaga Itar', 'Desa', '71552'],
            ['Kelua', 'Pulau', 'Kelurahan', '71552'],

            // =======================
            // TANTA – 71561
            // =======================
            ['Tanta', 'Barimbun', 'Desa', '71561'],
            ['Tanta', 'Lukbayur', 'Desa', '71562'],
            ['Tanta', 'Mangkusip', 'Desa', '71562'],
            ['Tanta', 'Murung Baru', 'Desa', '71562'],
            ['Tanta', 'Padang Panjang', 'Desa', '71561'],
            ['Tanta', 'Padangin', 'Desa', '71561'],
            ['Tanta', 'Pamarangan Kanan', 'Desa', '71561'],
            ['Tanta', 'Puain Kanan', 'Desa', '71561'],
            ['Tanta', 'Pulau Ku\'u', 'Desa', '71561'],
            ['Tanta', 'Tamiyang', 'Desa', '71561'],
            ['Tanta', 'Tanta', 'Desa', '71561'],
            ['Tanta', 'Tanta Hulu', 'Desa', '71561'],
            ['Tanta', 'Walangkir', 'Desa', '71561'],
            ['Tanta', 'Warukin', 'Desa', '71561'],

            // =======================
            // TANJUNG – 71514, 71512, 71513, 71515
            // =======================
            ['Tanjung', 'Agung', 'Kelurahan', '71514'],
            ['Tanjung', 'Hikun', 'Kelurahan', '71515'],
            ['Tanjung', 'Jangkung', 'Kelurahan', '71512'],
            ['Tanjung', 'Tanjung', 'Kelurahan', '71513'],

            ['Tanjung', 'Banyu Tajun', 'Desa', '71515'],
            ['Tanjung', 'Garunggung', 'Desa', '71515'],
            ['Tanjung', 'Juai', 'Desa', '71515'],
            ['Tanjung', 'Kambitin', 'Desa', '71515'],
            ['Tanjung', 'Kambitin Raya', 'Desa', '71515'],
            ['Tanjung', 'Kitang', 'Desa', '71515'],
            ['Tanjung', 'Mahe Seberang', 'Desa', '71515'],
            ['Tanjung', 'Pamarangan Kiwa', 'Desa', '71515'],
            ['Tanjung', 'Puain Kiwa', 'Desa', '71515'],
            ['Tanjung', 'Sungai Pimping', 'Desa', '71515'],
            ['Tanjung', 'Wayau', 'Desa', '71515'],

            // =======================
            // HARUAI – 71572
            // =======================
            ['Haruai', 'Bongkang', 'Desa', '71572'],
            ['Haruai', 'Catur Karya', 'Desa', '71572'],
            ['Haruai', 'Halong', 'Desa', '71572'],
            ['Haruai', 'Hayup', 'Desa', '71572'],
            ['Haruai', 'Kembang Kuning', 'Desa', '71572'],
            ['Haruai', 'Lokbatu', 'Desa', '71572'],
            ['Haruai', 'Mahe Pasar', 'Desa', '71572'],
            ['Haruai', 'Marindi', 'Desa', '71572'],
            ['Haruai', 'Nawin', 'Desa', '71572'],
            ['Haruai', 'Seradang', 'Desa', '71572'],
            ['Haruai', 'Suput', 'Desa', '71572'],
            ['Haruai', 'Suriyan', 'Desa', '71572'],
            ['Haruai', 'Wirang', 'Desa', '71572'],

            // =======================
            // MURUNG PUDAK – 71571
            // =======================
            ['Murung Pudak', 'Kapar', 'Desa', '71571'],
            ['Murung Pudak', 'Kasiau', 'Desa', '71571'],
            ['Murung Pudak', 'Kasiau Raya', 'Desa', '71571'],
            ['Murung Pudak', 'Maburai', 'Desa', '71571'],
            ['Murung Pudak', 'Masukau', 'Desa', '71571'],
            ['Murung Pudak', 'Belimbing', 'Kelurahan', '71571'],
            ['Murung Pudak', 'Belimbing Raya', 'Kelurahan', '71571'],
            ['Murung Pudak', 'Mabu\'un', 'Kelurahan', '71571'],
            ['Murung Pudak', 'Pembataan', 'Kelurahan', '71571'],
            ['Murung Pudak', 'Sulingan', 'Kelurahan', '71571'],

            // =======================
            // MUARA UYA – 71573
            // =======================
            ['Muara Uya', 'Binjai', 'Desa', '71573'],
            ['Muara Uya', 'Kampung Baru', 'Desa', '71573'],
            ['Muara Uya', 'Kupang Nunding', 'Desa', '71573'],
            ['Muara Uya', 'Lumbang', 'Desa', '71573'],
            ['Muara Uya', 'Mangkupum', 'Desa', '71573'],
            ['Muara Uya', 'Muara Uya', 'Desa', '71573'],
            ['Muara Uya', 'Palapi', 'Desa', '71573'],
            ['Muara Uya', 'Pasar Batu', 'Desa', '71573'],
            ['Muara Uya', 'Ribang', 'Desa', '71573'],
            ['Muara Uya', 'Salikung', 'Desa', '71573'],
            ['Muara Uya', 'Santu\'un', 'Desa', '71573'],
            ['Muara Uya', 'Simpung Layung', 'Desa', '71573'],
            ['Muara Uya', 'Sungai Kumap', 'Desa', '71573'],
            ['Muara Uya', 'Uwie', 'Desa', '71573'],

            // =======================
            // MUARA HARUS – 71555
            // =======================
            ['Muara Harus', 'Harus', 'Desa', '71555'],
            ['Muara Harus', 'Madang', 'Desa', '71555'],
            ['Muara Harus', 'Manduin', 'Desa', '71555'],
            ['Muara Harus', 'Mantuil', 'Desa', '71555'],
            ['Muara Harus', 'Murung Karangan', 'Desa', '71555'],
            ['Muara Harus', 'Padangin', 'Desa', '71555'],
            ['Muara Harus', 'Tantaringin', 'Desa', '71555'],

            // =======================
            // PUGAAN – 71554
            // =======================
            ['Pugaan', 'Halangan', 'Desa', '71554'],
            ['Pugaan', 'Jirak', 'Desa', '71554'],
            ['Pugaan', 'Pampanan', 'Desa', '71554'],
            ['Pugaan', 'Pugaan', 'Desa', '71554'],
            ['Pugaan', 'Sungai Rukam I', 'Desa', '71554'],
            ['Pugaan', 'Sungai Rukam II', 'Desa', '71554'],
            ['Pugaan', 'Tamunti', 'Desa', '71554'],

            // =======================
            // UPAU – 71575
            // =======================
            ['Upau', 'Bilas', 'Desa', '71575'],
            ['Upau', 'Kaong', 'Desa', '71575'],
            ['Upau', 'Kinarum', 'Desa', '71575'],
            ['Upau', 'Masingai I', 'Desa', '71575'],
            ['Upau', 'Masingai II', 'Desa', '71575'],
            ['Upau', 'Pangelak', 'Desa', '71575'],

            // =======================
            // JARO – 71574
            // =======================
            ['Jaro', 'Garagata', 'Desa', '71574'],
            ['Jaro', 'Jaro', 'Desa', '71574'],
            ['Jaro', 'Lano', 'Desa', '71574'],
            ['Jaro', 'Muang', 'Desa', '71574'],
            ['Jaro', 'Nalui', 'Desa', '71574'],
            ['Jaro', 'Namun', 'Desa', '71574'],
            ['Jaro', 'Purui', 'Desa', '71574'],
            ['Jaro', 'Solan', 'Desa', '71574'],
            ['Jaro', 'Teratau', 'Desa', '71574'],

            // =======================
            // BINTANG ARA – 71572
            // =======================
            ['Bintang Ara', 'Argo Mulyo', 'Desa', '71572'],
            ['Bintang Ara', 'Bintang Ara', 'Desa', '71572'],
            ['Bintang Ara', 'Bumi Makmur', 'Desa', '71572'],
            ['Bintang Ara', 'Burum', 'Desa', '71572'],
            ['Bintang Ara', 'Dambung Raya', 'Desa', '71572'],
            ['Bintang Ara', 'Hegar Manah', 'Desa', '71572'],
            ['Bintang Ara', 'Panaan', 'Desa', '71572'],
            ['Bintang Ara', 'Usih', 'Desa', '71572'],
            ['Bintang Ara', 'Waling', 'Desa', '71572'],
        ];

        // Insert ke database
        $insert = [];
        foreach ($data as $d) {
            $insert[] = [
                'kecamatan_id' => $kec[$d[0]] ?? null,
                'nama'         => $d[1],
                'jenis'        => $d[2],
                'kode_pos'     => $d[3],                
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }

        DB::table('desa_kelurahan')->insert($insert);
    }

    public function down(): void
    {
        Schema::dropIfExists('desa_kelurahan');
    }
};
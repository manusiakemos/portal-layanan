<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmartDesa extends Model
{
    use HasFactory;

    protected $table = 'smart_desa';

    protected $fillable = [
        'surat_permohonan_id',
        'kecamatan_id',
        'desa_kelurahan_id',
        'alamat',
        'jabatan',
        'skpd_nama',
        'nomor_aktif',
        'status_desa',
    ];

    public function suratPermohonan()
    {
        return $this->belongsTo(SuratPermohonan::class);
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
    public function desa()
    {
        return $this->belongsTo(DesaKelurahan::class, 'desa_kelurahan_id');
    }
    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'skpd_id');
    }    

}

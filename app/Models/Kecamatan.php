<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'nama',
        'kode_kecamatan',
        'active',
    ];

    public function desaKelurahan()
    {
        return $this->hasMany(DesaKelurahan::class, 'kecamatan_id');
    }
}

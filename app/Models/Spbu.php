<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Spbu extends Model
{
    // use SoftDeletes;

    protected $table = 'spbus';

    protected $fillable = [
        'nomor_spbu','tipe','alamat','kelurahan','kecamatan','kota',
        'potensi_konsumen','margin','slot','foto',
    ];

    public function pengajuans()
    {
        return $this->hasMany(\App\Models\Pengajuan::class);
    }
    
    protected $casts = [
        'potensi_konsumen' => 'integer',
        'slot'             => 'integer',
    ];
}

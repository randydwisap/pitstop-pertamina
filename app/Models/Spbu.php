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

    public function pengajuans(): HasMany
    {
        return $this->hasMany(Pengajuan::class, 'spbu_id');
    }
    protected $casts = [
        'potensi_konsumen' => 'integer',
        'slot'             => 'integer',
    ];
}

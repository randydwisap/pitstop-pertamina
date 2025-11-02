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
        'potensi_konsumen','margin','slot','foto','nama_pic','nomor_pic'
    ];

    public function pengajuans()
    {
        return $this->hasMany(\App\Models\Pengajuan::class);
    }
    
    protected $casts = [
        'potensi_konsumen' => 'integer',
        'slot'             => 'integer',
    ];
public function produks()
{
    return $this->hasManyThrough(
        \App\Models\Produk::class,
        \App\Models\Pengajuan::class,
        'spbu_id',     // Foreign key di tabel pengajuans
        'id',          // Foreign key di tabel produks
        'id',          // Local key di tabel spbus
        'product_id'   // Local key di tabel pengajuans
    )
    ->select('produks.*', 'pengajuans.spbu_id as laravel_through_key');
}
}

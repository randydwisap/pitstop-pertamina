<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'picture',
        'nama_produk',
        'harga_jual',
        'jenis_produk',
        'ekspektasi_penjualan',
        'is_active',
        'toko_id',
        'user_id',
    ];
       
    protected $casts = [
        'is_active'  => 'boolean',
        'harga_jual' => 'decimal:2',
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

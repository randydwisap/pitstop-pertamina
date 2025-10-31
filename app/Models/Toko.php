<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Toko extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_toko',
        'alamat_toko',
        'foto',
        'user_id',
        'telephone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    
}

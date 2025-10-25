<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
    // use SoftDeletes;

    protected $fillable = [
        'product_id','spbu_id','status',
        'created_by','approved_by','approved_at',
        'quantity','notes',
    ];

    protected $casts = ['approved_at' => 'datetime','approved_by' => 'integer',];

    public function product() { return $this->belongsTo(Produk::class, 'product_id'); }
    public function spbu()    { return $this->belongsTo(Spbu::class, 'spbu_id'); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function approver(){ return $this->belongsTo(User::class, 'approved_by'); }
}

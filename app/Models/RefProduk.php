<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefProduk extends Model
{
    use HasFactory;
    protected $table = 'ref_produk';
    protected $fillable = [
        'nama',
        'harga',
        'gambar_produk',
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo(RefStatus::class, 'status_id');
    }
}

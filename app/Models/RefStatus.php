<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefStatus extends Model
{
    use HasFactory;
    protected $table = 'ref_status';
    protected $fillable = [
        'nama_status',
        'style'
    ];
    public $timestamps = false;

    public function produk()
    {
        return $this->hasMany(RefProduk::class, 'status_id');
    }
    public function pengguna()
    {
        return $this->hasMany(RefPengguna::class, 'status_id');
    }
}

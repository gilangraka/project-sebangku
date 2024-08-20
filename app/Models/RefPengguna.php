<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPengguna extends Model
{
    use HasFactory;
    protected $table = 'ref_pengguna';
    protected $fillable = [
        'user_id',
        'nomor_telepon',
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo(RefStatus::class, 'status_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $guarded = [];

    public function peminjaman_details()
    {
        return $this->hasMany(PeminjamanDetails::class, 'peminjaman_id', 'id_peminjaman');
    }
}

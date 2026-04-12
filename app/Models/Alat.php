<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alat extends Model
{
    protected $table = 'alat'; 
    protected $fillable = [
        'nama_alat',
        'kategori_id',
        'stok',
        'harga_sewa',
        'deskripsi',
        'foto_alat'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman_details() {
        return $this->hasMany(PeminjamanDetails::class, 'alat_id', 'id');
    }
}

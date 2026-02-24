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
        'deskripsi'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}

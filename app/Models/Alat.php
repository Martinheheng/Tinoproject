<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;

class Alat extends Model
{
    protected $table = 'alat';

    protected $fillable = [
        'nama_alat',
        'kategori_id',
        'stok',
        'harga_sewa',
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // 🔥 INI WAJIB ADA
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function getStatusAttribute()
    {
        return $this->stok > 0 ? 'tersedia' : 'dipinjam';
    }
}
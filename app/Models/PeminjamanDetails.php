<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// app/Models/PeminjamanDetails.php
class PeminjamanDetails extends Model
{
    protected $table = 'peminjaman_details'; // atau 'peminjaman_detail'
    protected $fillable = ['peminjaman_id', 'alat_id', 'jumlah'];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id', 'id_peminjaman');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }
}

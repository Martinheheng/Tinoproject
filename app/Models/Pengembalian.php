<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $fillable = ['peminjaman_id', 'tanggal_kembali_real', 'denda', 'catatan', 'petugas_id'];
    public function peminjaman() { return $this->belongsTo(Peminjaman::class); }
}

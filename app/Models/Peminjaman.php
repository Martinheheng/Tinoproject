<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id', 'subtotal', 'deposit', 'total', 'metode_pembayaran',
        'tanggal_pinjam', 'tanggal_pengembalian', 'status', 'petugas_id'
    ];

    // Accessor agar $peminjaman->id mengembalikan id_peminjaman (untuk kompatibilitas)
    public function getIdAttribute()
    {
        return $this->id_peminjaman;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(PeminjamanDetails::class, 'peminjaman_id', 'id_peminjaman');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id', 'id_peminjaman');
    }
}

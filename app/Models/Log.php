<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log_aktifitas'; // kalau tabel kamu masih pakai nama ini

    protected $fillable = [
        'user_id',
        'aksi',
        'deskripsi',
        'role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
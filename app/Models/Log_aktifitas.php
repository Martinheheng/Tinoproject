<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_aktifitas extends Model
{
   protected $table = 'log_aktifitas';

protected $fillable = [
    'user_id',
    'role',
    'aksi',
    'target_type',
    'target_id',
    'deskripsi'
];

public function user()
{
    return $this->belongsTo(User::class);
}
}

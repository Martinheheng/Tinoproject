<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang_items extends Model
{
    use HasFactory;

    protected $table = 'keranjang_items', $guarded = [];

    public function keranjang()
    {
        return $this->belongsTo(keranjang::class, 'keranjang_id', 'id');
    }

    public function alat()
    {
        return $this->belongsTo(alat::class, 'alat_id', 'id');
    }

}

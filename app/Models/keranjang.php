<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang', $guarded = [];

    public function keranjang_items()
    {
        return $this->hasMany(keranjang_items::class, 'keranjang_id');
    }
}

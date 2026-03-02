<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Joran', 'Umpan', 'Senar', 'Kail'] as $kategori) {
            kategori::create(['nama_kategori' => $kategori]);
        }
    }
}

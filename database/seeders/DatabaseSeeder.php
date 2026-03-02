<?php

namespace Database\Seeders;

use App\Models\alat;
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

        alat::create([
           'foto_alat' => 'link-foto', 
           'nama_alat' => 'Joran',
           'kategori_id' => 1,
           'stok' => 10,
           'harga_sewa' => 10000,
           'deskripsi' => 'Joran Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis officiis obcaecati neque veniam quo possimus explicabo mollitia atque nulla impedit!'
        ]);
    }
}

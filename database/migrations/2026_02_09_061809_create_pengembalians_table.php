<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('pengembalian', function (Blueprint $table) {
    // 1. Primary Key untuk tabel pengembalian
    $table->id(); 
    // 2. Foreign Key ke tabel peminjaman (GANTI 'id' JADI 'peminjaman_id')
    // Sesuaikan parameter kedua 'id_peminjaman' jika itu nama PK di tabel peminjaman kamu
    $table->foreignId('peminjaman_id')->constrained('peminjaman', 'id_peminjaman');

    $table->date('tanggal_pengembalian');
    $table->enum('kondisi', ['baik', 'rusak', 'perbaikan'])->default('baik');
    $table->decimal('denda', 10, 2)->default(0);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengembalians');
    }
};

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
    Schema::create('peminjaman', function (Blueprint $table) {
        $table->id('id_peminjaman');

        // Harus pakai foreignId dulu supaya Laravel tahu ini kolom ID untuk relasi
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('alat_id')->constrained('alat');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_pengembalian');
        $table->enum('status', ['menunggu', 'disetujui', 'dipinjam', 'dikembalikan', 'ditolak'])->default('menunggu');
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
        Schema::dropIfExists('peminjaman');
    }
};

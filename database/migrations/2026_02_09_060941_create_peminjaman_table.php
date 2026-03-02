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
        $table->integer('subtotal');
        $table->integer('deposit');
        $table->integer('total');
        $table->string('metode_pembayaran');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_pengembalian');
        $table->enum('status', ['menunggu', 'disetujui', 'dipinjam', 'dikembalikan', 'ditolak'])->default('menunggu');
        $table->date('dikembalikan_pada')->nullable();
        $table->enum('status_pengembalian', ['terlambat', 'tepat waktu'])->nullable();
        $table->integer('total_terlambat')->nullable();
        $table->integer('denda')->nullable();
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

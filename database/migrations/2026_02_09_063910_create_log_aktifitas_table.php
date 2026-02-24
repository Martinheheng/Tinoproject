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
       Schema::create('log_aktifitas', function (Blueprint $table) {
    // 1. Primary Key untuk baris log ini sendiri
    $table->id(); 

    // 2. Foreign Keys (GANTI SEMUA 'id' JADI NAMA UNIK)
    // Jika log ini mencatat aksi User
    $table->foreignId('user_id')->constrained('users'); 
    // 3. Kolom lainnya
    $table->string('role');
    $table->enum('aksi', ['login', 'logout', 'pinjam', 'kembali', 'setujui', 'tolak', 'denda', 'update', 'hapus']);
    $table->string('target_type')->nullable();
    $table->unsignedBigInteger('target_id')->nullable();
    $table->string('deskripsi');
    $table->date('waktu');
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
        Schema::dropIfExists('log_aktifitas');
    }
};

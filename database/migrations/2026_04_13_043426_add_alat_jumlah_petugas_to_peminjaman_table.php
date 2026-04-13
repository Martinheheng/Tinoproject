<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            // Tambahkan kolom alat_id setelah user_id
            $table->foreignId('alat_id')->nullable()->after('user_id')->constrained()->onDelete('restrict');
            // Tambahkan kolom jumlah
            $table->integer('jumlah')->default(1)->after('alat_id');
            // Tambahkan kolom petugas_id
            $table->foreignId('petugas_id')->nullable()->after('status')->constrained('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropForeign(['alat_id']);
            $table->dropColumn('alat_id');
            $table->dropColumn('jumlah');
            $table->dropForeign(['petugas_id']);
            $table->dropColumn('petugas_id');
        });
    }
};

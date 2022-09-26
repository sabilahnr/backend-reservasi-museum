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
        Schema::create('pengunjung', function (Blueprint $table) {
           
            $table->id();
            $table->string('nama');
            $table->string('kota');
            $table->string('phone')->nullable();
            $table->string('jumlah');
            $table->enum('museum',['museum_keris','museum_radya_pustaka']);
            $table->enum('kategori',['umum','mahasiswa', 'pelajar', 'rombongan_umum', 'rombongan_pelajar', 'wna']);
            $table->string('tanggal');
            $table->string('foto');
            $table->string('harga');
            $table->string('pembayaran');
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
        Schema::dropIfExists('pengunjung');
    }
};

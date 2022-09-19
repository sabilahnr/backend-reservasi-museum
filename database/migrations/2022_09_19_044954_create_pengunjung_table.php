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
            $table->string('kota_asal');
            $table->string('negara');
            $table->string('phone')->nullable();
            $table->string('jumlah_pengunjung')->nullable();
            $table->enum('museum',['museum_keris','museum_radya_pustaka']);
            $table->enum('nama_kategori',['umum','mahasiswa', 'pelajar', 'rombongan_umum', 'rombongan_pelajar', 'wna']);
            $table->string('jadwal');
            $table->string('foto_ktp');
            $table->string('foto_kia');
            $table->string('foto_paspor');
            $table->string('file');
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

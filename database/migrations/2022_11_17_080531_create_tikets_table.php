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
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket');
            $table->string('id_pengunjung');
            $table->string('nama');
            $table->string('museum');
            $table->string('kategori');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('status')->nullable();
            $table->string('kehadiran')->nullable();
            $table->string('tanggal');
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
        Schema::dropIfExists('tikets');
    }
};

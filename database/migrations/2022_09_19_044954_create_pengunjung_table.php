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
            $table->string('museum');
            $table->string('kategori');
            $table->string('phone');
            $table->string('kota');
            $table->string('negara')->nullable();
            $table->string('jumlah');
            $table->string('harga_awal');
            $table->string('tanggal');
            $table->string('email');
            $table->string('attachment')->nullable();
            $table->string('pembayaran');
            $table->string('id_admin')->nullable();
            $table->string('status')->nullable();
            $table->string('kehadiran')->nullable();
            $table->string('tanggal_pembayaran')->nullable();
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

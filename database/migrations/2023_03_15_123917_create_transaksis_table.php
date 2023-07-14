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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('id_kategori'); // Menggunakan tipe data unsignedBigInteger
            $table->string('phone');
            $table->string('kota');
            $table->string('jumlah');
            $table->string('total_harga');
            $table->string('tanggal');
            $table->string('email');
            $table->string('pembayaran');
            $table->string('kode_tiket')->nullable();
            $table->string('id_admin')->nullable();
            $table->string('kehadiran')->nullable();
            $table->string('status')->default('pending');
            $table->string('tanggal_pembayaran')->nullable();
            $table->string('tanggal_kehadiran')->nullable();
            $table->string('invoice')->nullable();
            $table->timestamps();

            // Definisikan kunci asing ke tabel kategori
            $table->foreign('id_kategori')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};

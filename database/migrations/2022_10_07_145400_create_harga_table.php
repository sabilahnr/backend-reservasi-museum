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
        Schema::create('harga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_museum')->references('id')->on('museum')->constrained();
            $table->foreignId('id_kategori')->references('id')->on('kategori')->constrained();
            // $table->integer('id_kategori')->unsigned();;
            $table->string('hari_biasa');
            $table->string('hari_libur');
            $table->timestamps();
            // $table->foreign('id_kategori')->references('id')->on('kategori')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harga');
    }
};

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
       Schema::dropIfExists('failed_jobs');
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::create('failed_jobs', function (Blueprint $table) {
           $table->id();
           $table->text('connection');
           $table->text('queue');
           $table->longText('payload');
           $table->timestamp('failed_at')->useCurrent();
       });
   }
};

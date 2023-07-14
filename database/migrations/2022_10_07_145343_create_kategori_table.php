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
            Schema::create('kategori', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_museum')->references('id')->on('museum')->constrained();
                $table->string('nama_kategori');
                $table->string('nama_kategori_en');
                $table->string('hari_biasa');
                $table->string('hari_libur');
                $table->string('min');
                $table->string('max');
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
            Schema::dropIfExists('kategori');
        }
    };

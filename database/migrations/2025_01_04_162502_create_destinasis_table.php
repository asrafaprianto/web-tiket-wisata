<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinasis', function (Blueprint $table) {
            $table->id();
            $table->string('destinasi_id')->unique(); // Ubah tipe data menjadi string dan tambahkan unique constraint
            $table->string('nama');
            $table->string('gambar');
            $table->string('alamat');
            $table->string('kontak', 20); // Menambahkan panjang yang cukup untuk kolom kontak
            $table->text('peraturan');
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
        Schema::dropIfExists('destinasis');
    }
}
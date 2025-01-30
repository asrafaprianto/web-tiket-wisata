<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // Primary Key Auto Increment
            $table->string('produk_id')->unique(); // Produk ID unik
            $table->string('nama_produk');
            $table->decimal('harga', 10, 2);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('produks');
    }
}
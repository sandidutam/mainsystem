<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventori', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->nullable();
            $table->string('nama');
            $table->string('merk');
            $table->string('jenis');
            $table->string('deskripsi')->nullable();
            $table->integer('kuantitas');
            $table->string('satuan');
            $table->string('harga');
            $table->string('gambar');
            $table->integer('stok_minimal');
            $table->string('status');
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
        Schema::dropIfExists('inventori');
    }
}

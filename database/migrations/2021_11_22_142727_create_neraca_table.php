<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeracaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neraca', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_akun')->nullable();
            $table->string('akun');
            $table->string('deskripsi')->nullable();
            $table->string('debit')->nullable();
            $table->string('kredit')->nullable();
            $table->string('tanggal');
            $table->string('foto_bukti')->nullable();
            $table->string('file_bukti')->nullable();
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
        Schema::dropIfExists('neraca');
    }
}

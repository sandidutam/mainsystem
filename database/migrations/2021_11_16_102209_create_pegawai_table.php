<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('nomor_pegawai')->nullable();
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->text('alamat');
            $table->string('provinsi');
            $table->string('kota_kabupaten');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('pendidikan');
            $table->string('jabatan');
            $table->string('penempatan');
            $table->string('sektor_area');
            $table->date('tanggal_diterima');
            $table->string('no_hp')->nullable();
            $table->string('foto_pegawai');
            // $table->string('qr_code');
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
        Schema::dropIfExists('pegawai');
    }
}

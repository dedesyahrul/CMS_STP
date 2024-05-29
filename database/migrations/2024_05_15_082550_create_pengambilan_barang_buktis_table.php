<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengambilanBarangBuktisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengambilan_barang_buktis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barang_bukti_id');
            $table->string('nama_pengambil_barang_bukti');
            $table->string('nomor_hp');
            $table->string('metode_pengambilan');
            $table->string('wilayah_pengantar')->nullable();
            $table->text('alamat_pengantaran')->nullable();
            $table->date('tanggal_pengantaran')->nullable();
            $table->string('foto_ktp_kk_sim')->nullable();
            $table->string('status')->default('belum diambil');
            $table->timestamps();

            $table->foreign('barang_bukti_id')->references('id')->on('barang_buktis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengambilan_barang_buktis');
    }
}

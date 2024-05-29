<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangBuktisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_buktis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_perkara_id');
            $table->foreign('data_perkara_id')->references('id')->on('data_perkaras')->onDelete('cascade');
            $table->string('nama_pemilik_barang_bukti');
            $table->string('barang_bukti');
            $table->string('lokasi_barang_bukti');
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
        Schema::dropIfExists('barang_buktis');
    }
}
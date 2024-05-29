<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaTersangkaToPengambilanBarangBuktisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengambilan_barang_buktis', function (Blueprint $table) {
            $table->string('nama_tersangka')->nullable()->after('barang_bukti_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengambilan_barang_buktis', function (Blueprint $table) {
            $table->dropColumn('nama_tersangka');
        });
    }
}

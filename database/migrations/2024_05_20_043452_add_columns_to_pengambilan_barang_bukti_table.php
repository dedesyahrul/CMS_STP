<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPengambilanBarangBuktiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengambilan_barang_buktis', function (Blueprint $table) {
            $table->string('penerima_kuasa')->nullable();
            $table->string('surat_kuasa')->nullable();
            $table->string('penerima_surat_kuasa')->nullable();
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
            $table->dropColumn('penerima_kuasa');
            $table->dropColumn('surat_kuasa');
            $table->dropColumn('penerima_surat_kuasa');
        });
    }
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSerahTerimaColumnsToBarangBuktisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('barang_buktis', function (Blueprint $table) {
            $table->string('ba_serah_terima')->nullable();
            $table->string('d_serah_terima')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_buktis', function (Blueprint $table) {
            $table->dropColumn('ba_serah_terima');
            $table->dropColumn('d_serah_terima');
        });
    }
}

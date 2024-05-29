<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahPengantarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wilayahs = [
            ['nama' => 'KECAMATAN MUARA SABAK TIMUR'],
            ['nama' => 'KECAMATAN NIPAH PANJANG'],
            ['nama' => 'KECAMATAN MENDAHARA'],
            ['nama' => 'KECAMATAN RANTAU RASAU'],
            ['nama' => 'KECAMATAN SADU'],
            ['nama' => 'KECAMATAN DENDANG'],
            ['nama' => 'KECAMATAN MUARA SABAK BARAT'],
            ['nama' => 'KECAMATAN KUALA JAMBI'],
            ['nama' => 'KECAMATAN MENDAHARA ULU'],
            ['nama' => 'KECAMATAN GERAGAI'],
            ['nama' => 'KECAMATAN BERBAK'],
        ];

        DB::table('wilayah_pengantars')->insert($wilayahs);
    }
}
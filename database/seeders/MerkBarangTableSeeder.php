<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerkBarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $merkBarang = [
            ['merk_nama' => 'Merk1', 'merk_slug' => 'merk1', 'merk_keterangan' => 'ket merk1'],
            ['merk_nama' => 'Merk2', 'merk_slug' => 'merk2', 'merk_keterangan' => 'ket merk2'],
        ];
 
        DB::table('tbl_merk')->insert($merkBarang);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanBarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuanBarang = [
            ['satuan_nama' => 'Pcs', 'satuan_slug' => 'pcs', 'satuan_keterangan' => 'satuan pcs'],
            ['satuan_nama' => 'Kg', 'satuan_slug' => 'kg', 'satuan_keterangan' => 'satuan kg'],
        ];
 
        DB::table('tbl_satuan')->insert($satuanBarang);
    }
}

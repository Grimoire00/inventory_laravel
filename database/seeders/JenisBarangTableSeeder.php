<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisBarang = [
            ['jenisbarang_nama' => 'Darat', 'jenisbarang_slug' => 'darat', 'jenisbarang_keterangan' => 'Jenis barang darat'],
            ['jenisbarang_nama' => 'Laut', 'jenisbarang_slug' => 'laut', 'jenisbarang_keterangan' => 'Jenis barang laut'],
            ['jenisbarang_nama' => 'Udara', 'jenisbarang_slug' => 'udara', 'jenisbarang_keterangan' => 'Jenis barang udara'],
        ];
 
        DB::table('tbl_jenisbarang')->insert($jenisBarang);
    }
}

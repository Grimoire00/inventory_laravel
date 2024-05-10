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
            ['jenisbarang_nama' => 'Skincare', 'jenisbarang_slug' => 'skincare', 'jenisbarang_ket' => ' Jenis barang skincare'],
            ['jenisbarang_nama' => 'Obat', 'jenisbarang_slug' => 'obat', 'jenisbarang_ket' => 'Jenis barang obat'],
        ];
 
        DB::table('tbl_jenisbarang')->insert($jenisBarang);
    }
}

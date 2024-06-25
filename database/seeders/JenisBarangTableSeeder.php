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
            ['jenisbarang_nama' => 'Cleanser', 'jenisbarang_slug' => 'cleanser', 'jenisbarang_ket' => ' Jenis barang cleanser'],
            ['jenisbarang_nama' => 'Body Care', 'jenisbarang_slug' => 'body-care', 'jenisbarang_ket' => 'Jenis barang body care'],
            ['jenisbarang_nama' => 'Obat Herbal', 'jenisbarang_slug' => 'obat-herbal', 'jenisbarang_ket' => 'Jenis barang obat herbal']
        ];
 
        DB::table('tbl_jenisbarang')->insert($jenisBarang);
    }
}

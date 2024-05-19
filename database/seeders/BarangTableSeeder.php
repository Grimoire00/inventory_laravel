<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang =[
            [
                'jenisbarang_id' => 1,
                'satuan_id' => 1,
                'merk_id' => 1,
                'user_id' => 1,
                'barang_kode' => 'BRG-0234234231',
                'barang_nama' => 'Barang Satu',
                'barang_slug' => Str::slug('Barang Satu'),
                'barang_harga' => 10000,
                'barang_stok' => 50,
                'barang_gambar' => 'barang1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenisbarang_id' => 2,
                'satuan_id' => 2,
                'merk_id' => 2,
                'user_id' => 2,
                'barang_kode' => 'BRG-987349872498',
                'barang_nama' => 'Barang Dua',
                'barang_slug' => Str::slug('Barang Dua'),
                'barang_harga' => 20000,
                'barang_stok' => 30,
                'barang_gambar' => 'barang2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('tbl_barang')->insert($barang);
    }
}

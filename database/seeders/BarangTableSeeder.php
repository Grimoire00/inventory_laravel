<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $dataBarang = [];
 
        // Mendapatkan id dari masing-masing jenis barang
        $jenisBarangIds = DB::table('tbl_jenisbarang')->pluck('jenisbarang_id');
 
        // Membuat 5 data barang untuk setiap jenis barang
        foreach ($jenisBarangIds as $jenisbarang_id) {
            for ($i = 1; $i <= 5; $i++) {
                $dataBarang[] = [
                    'jenisbarang_id' => $jenisbarang_id,
                    'barang_kode' => 'Kode' . $i,
                    'barang_nama' => 'Nama Barang ' . $i,
                    'barang_slug' => 'nama-barang-' . $i,
                    'barang_harga' => rand(10, 100) * 1000, // Harga random antara 10.000 dan 100.000
                    'barang_stok' => rand(1, 100),
                    'barang_gambar' => 'gambar_barang_' . $i . '.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
 
        DB::table('tbl_barang')->insert($dataBarang);
    }
}

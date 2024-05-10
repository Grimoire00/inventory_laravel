<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier =[
            ['supplier_nama' => 'Supplier1', 'supplier_slug' => 'supplier1', 'supplier_alamat' => 'Jl. alamat supplier1', 'supplier_notelp' => '089123456789',],
            ['supplier_nama' => 'Supplier2', 'supplier_slug' => 'supplier2', 'supplier_alamat' => 'Jl. alamat supplier2', 'supplier_notelp' => '089123456788',]
        ];
        DB::table('tbl_supplier')->insert($supplier);
    }
}

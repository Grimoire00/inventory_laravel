<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer =[
            ['customer_nama' => 'Customer1', 'customer_slug' => 'Customer1', 'customer_alamat' => 'Jl. alamat customer1', 'customer_notelp' => '089123456789',],
            ['customer_nama' => 'Customer2', 'customer_slug' => 'Customer2', 'customer_alamat' => 'Jl. alamat customer2', 'customer_notelp' => '089123456788',]
        ];
        DB::table('tbl_customer')->insert($customer);
    }
}

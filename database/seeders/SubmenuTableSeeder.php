<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class submenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_submenu')->insert(
            [
                // submenu
                // Master Barang
                [
                    'submenu_id' => '1667444051',
                    'menu_id' => '1667444044',
                    'submenu_judul' => 'Jenis',
                    'submenu_slug' => 'jenis',                    
                    'submenu_redirect' => '/jenisbarang',
                    'submenu_sort' => 1,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'submenu_id' => '1667444052',
                    'menu_id' => '1667444044',
                    'submenu_judul' => 'Satuan',
                    'submenu_slug' => 'satuan',                    
                    'submenu_redirect' => '/satuan',
                    'submenu_sort' => 2,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'submenu_id' => '1667444053',
                    'menu_id' => '1667444044',
                    'submenu_judul' => 'Merk',
                    'submenu_slug' => 'merk',                    
                    'submenu_redirect' => '/merk',
                    'submenu_sort' => 3,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],                    
                [
                    'submenu_id' => '1667444054',
                    'menu_id' => '1667444044',
                    'submenu_judul' => 'Barang',
                    'submenu_slug' => 'barang',                    
                    'submenu_redirect' => '/barang',
                    'submenu_sort' => 4,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'submenu_id' => '1667444055',
                    'menu_id' => '1667444044',
                    'submenu_judul' => 'Min Max',
                    'submenu_slug' => 'min-max',                    
                    'submenu_redirect' => '',
                    'submenu_sort' => 5,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],                    
                // Data Manajemen Barang
                [
                    'submenu_id' => '1667444056',
                    'menu_id' => '1667444045',
                    'submenu_judul' => 'Barang Masuk',
                    'submenu_slug' => 'barang-masuk',                    
                    'submenu_redirect' => '/barang-masuk',
                    'submenu_sort' => 1,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],                            
                [
                    'submenu_id' => '1667444057',
                    'menu_id' => '1667444045',
                    'submenu_judul' => 'Barang Keluar',
                    'submenu_slug' => 'barang-keluar',                    
                    'submenu_redirect' => '/barang-keluar',
                    'submenu_sort' => 2,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],             
                // Pemesanan Barang
                [
                    'submenu_id' => '1667444058',
                    'menu_id' => '1667444046',
                    'submenu_judul' => 'Pemesanan Barang',
                    'submenu_slug' => 'pemesanan-barang',                    
                    'submenu_redirect' => '/pemesanan-barang',
                    'submenu_sort' => 1,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],                            
                [
                    'submenu_id' => '1667444059',
                    'menu_id' => '1667444046',
                    'submenu_judul' => 'Konfirmasi Pemesanan',
                    'submenu_slug' => 'konfirmasi-pemesanan',                    
                    'submenu_redirect' => '/konfirmasi-pemesanan',
                    'submenu_sort' => 2,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],            
                // laporan
                [
                    'submenu_id' => '1667444060',
                    'menu_id' => '1667444047',
                    'submenu_judul' => 'Lap. Barang Masuk',
                    'submenu_slug' => 'laporan-barang-masuk',                    
                    'submenu_redirect' => '/lap-barang-masuk',
                    'submenu_sort' => 1,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],                        
                [
                    'submenu_id' => '1667444061',
                    'menu_id' => '1667444047',
                    'submenu_judul' => 'Lap. Barang Keluar',
                    'submenu_slug' => 'laporan-barang-keluar',                    
                    'submenu_redirect' => '/lap-barang-keluar',
                    'submenu_sort' => 2,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],                        
                [
                    'submenu_id' => '1667444062',
                    'menu_id' => '1667444047',
                    'submenu_judul' => 'Lap. Stok Barang',
                    'submenu_slug' => 'laporan-stok-barang',                    
                    'submenu_redirect' => '/lap-stok-barang',
                    'submenu_sort' => 3,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                
                [
                    'submenu_id' => '1667444063',
                    'menu_id' => '1667444047',
                    'submenu_judul' => 'Lap. Pemesanan Barang',
                    'submenu_slug' => 'laporan-pemesanan-barang',                    
                    'submenu_redirect' => '',
                    'submenu_sort' => 4,                
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],                           
            ]
        );
    }
}

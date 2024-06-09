<?php

use App\Models\Admin\BarangModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MerkController;
use App\Http\Controllers\Master\WebController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Master\MenuController;
use App\Http\Controllers\Master\RoleController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Master\AksesController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MinMaxController;
use App\Http\Controllers\Admin\PemesananBarangController;
use App\Http\Controllers\KonfirmasiBarangController;
use App\Http\Controllers\Master\AppreanceController;
use App\Http\Controllers\Admin\BarangmasukController;
use App\Http\Controllers\Admin\JenisBarangController;
use App\Http\Controllers\Admin\BarangkeluarController;
use App\Http\Controllers\Admin\KonfirmasiPemesananController;
use App\Http\Controllers\Admin\LapStokBarangController;
use App\Http\Controllers\Admin\LapBarangMasukController;
use App\Http\Controllers\Admin\LapBarangKeluarController;
use App\Http\Controllers\Admin\LapPemesananBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// login admin
Route::middleware(['preventBackHistory'])->group(function () {
    Route::get('/admin/login', [LoginController::class, 'index'])->middleware('useractive');
    Route::post('/admin/proseslogin', [LoginController::class, 'proseslogin'])->middleware('useractive');
    Route::get('/admin/logout', [LoginController::class, 'logout']);
});

// admin
Route::group(['middleware' => 'userlogin'], function () {

    // Profile
    Route::get('/admin/profile/{user}', [UserController::class, 'profile']);
    Route::post('/admin/updatePassword/{user}', [UserController::class, 'updatePassword']);
    Route::post('/admin/updateProfile/{user}', [UserController::class, 'updateProfile']);
    Route::get('/admin/appreance/', [AppreanceController::class, 'index']);
    Route::post('/admin/appreance/{setting}', [AppreanceController::class, 'update']);

    Route::middleware(['checkRoleUser:/dashboard,menu'])->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/admin', [DashboardController::class, 'index']);
        Route::get('/admin/dashboard', [DashboardController::class, 'index']);
        Route::get('/admin/dashboard/show', [DashboardController::class, 'show']);
    });

    Route::middleware(['checkRoleUser:/jenisbarang,submenu'])->group(function () {
        // Jenis Barang
        Route::get('/admin/jenisbarang', [JenisBarangController::class, 'index']);
        Route::get('/admin/jenisbarang/show/', [JenisBarangController::class, 'show'])->name('jenisbarang.getjenisbarang');
        Route::post('/admin/jenisbarang/proses_tambah/', [JenisBarangController::class, 'proses_tambah'])->name('jenisbarang.store');
        Route::post('/admin/jenisbarang/proses_ubah/{jenisbarang}', [JenisBarangController::class, 'proses_ubah']);
        Route::post('/admin/jenisbarang/proses_hapus/{jenisbarang}', [JenisBarangController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/satuan,submenu'])->group(function () {
        // Satuan
        Route::resource('/admin/satuan', SatuanController::class)->except('store');
        Route::get('/admin/satuan/show/', [SatuanController::class, 'show'])->name('satuan.getsatuan');
        Route::post('/admin/satuan/proses_tambah/', [SatuanController::class, 'proses_tambah'])->name('satuan.store-data');
        Route::post('/admin/satuan/proses_ubah/{satuan}', [SatuanController::class, 'proses_ubah']);
        Route::post('/admin/satuan/proses_hapus/{satuan}', [SatuanController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/merk,submenu'])->group(function () {
        // Merk
        Route::resource('/admin/merk', MerkController::class)->except('store');
        Route::get('/admin/merk/show/', [MerkController::class, 'show'])->name('merk.getmerk');
        Route::post('/admin/merk/proses_tambah/', [MerkController::class, 'proses_tambah'])->name('merk.store');
        Route::post('/admin/merk/proses_ubah/{merk}', [MerkController::class, 'proses_ubah']);
        Route::post('/admin/merk/proses_hapus/{merk}', [MerkController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/barang,submenu'])->group(function () {
        // Barang
        Route::resource('/admin/barang', BarangController::class)->except('store');
        Route::get('/admin/barang/show/', [BarangController::class, 'show'])->name('barang.getbarang');
        Route::post('/admin/barang/proses_tambah/', [BarangController::class, 'proses_tambah'])->name('barang.store');
        Route::post('/admin/barang/proses_ubah/{barang}', [BarangController::class, 'proses_ubah']);
        Route::post('/admin/barang/proses_hapus/{barang}', [BarangController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/minmax,submenu'])->group(function () {
        // MinMax
        Route::get('/admin/minmax/proses_ubah', [MinMaxController::class, 'proses_ubah'])->name('minmax.proses_ubah');
        Route::post('/admin/minmax/proses_ubah_store', [MinMaxController::class, 'proses_ubah_store']);    
        Route::resource('/admin/minmax', MinMaxController::class)->except('store');
        Route::get('/admin/minmax/show/', [MinMaxController::class, 'show'])->name('minmax.getminmax');
        
        // phpRoute::post('/admin/minmax/proses_tambah/', [MinMaxController::class, 'proses_tambah'])->name('minmax.store-data');
        // Route::post('/admin/minmax/proses_hapus/{minmax}', [SatuanController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/customer,menu'])->group(function () {
        // Customer
        Route::resource('/admin/customer', CustomerController::class)->except('store');
        Route::get('/admin/customer/show/', [CustomerController::class, 'show'])->name('customer.getcustomer');
        Route::post('/admin/customer/proses_tambah/', [CustomerController::class, 'proses_tambah'])->name('customer.store');
        Route::post('/admin/customer/proses_ubah/{customer}', [CustomerController::class, 'proses_ubah']);
        Route::post('/admin/customer/proses_hapus/{customer}', [CustomerController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/supplier,menu'])->group(function () {
        // Supplier
        Route::resource('/admin/supplier', SupplierController::class)->except('store');
        Route::get('/admin/supplier/show/', [SupplierController::class, 'show'])->name('supplier.getsupplier');
        Route::post('/admin/supplier/proses_tambah/', [SupplierController::class, 'proses_tambah'])->name('supplier.store');
        Route::post('/admin/supplier/proses_ubah/{supplier}', [SupplierController::class, 'proses_ubah']);
        Route::post('/admin/supplier/proses_hapus/{supplier}', [SupplierController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/barang-masuk,submenu'])->group(function () {
        // Barang Masuk
        Route::resource('/admin/barang-masuk', BarangmasukController::class)->except('store');
        Route::get('/admin/barang-masuk/show/', [BarangmasukController::class, 'show'])->name('barang-masuk.getbarang-masuk');
        Route::post('/admin/barang-masuk/proses_tambah/', [BarangmasukController::class, 'proses_tambah'])->name('barang-masuk.store');
        Route::post('/admin/barang-masuk/proses_ubah/{barangmasuk}', [BarangmasukController::class, 'proses_ubah']);
        Route::post('/admin/barang-masuk/proses_hapus/{barangmasuk}', [BarangmasukController::class, 'proses_hapus']);
        Route::get('/admin/barang/getbarang/{id}', [BarangController::class, 'getbarang']);        
        Route::get('/admin/barang/listbarang/{param}', [BarangController::class, 'listbarang']);
    });

    Route::middleware(['checkRoleUser:/lap-barang-masuk,submenu'])->group(function () {
        // Barang Keluar
        Route::resource('/admin/barang-keluar', BarangkeluarController::class)->except('store');
        Route::get('/admin/barang-keluar/show/', [BarangkeluarController::class, 'show'])->name('barang-keluar.getbarang-keluar');
        Route::post('/admin/barang-keluar/proses_tambah/', [BarangkeluarController::class, 'proses_tambah'])->name('barang-keluar.store');
        Route::post('/admin/barang-keluar/proses_ubah/{barangkeluar}', [BarangkeluarController::class, 'proses_ubah']);
        Route::post('/admin/barang-keluar/proses_hapus/{barangkeluar}', [BarangkeluarController::class, 'proses_hapus']);
    });

    Route::middleware(['checkRoleUser:/lap-barang-masuk,submenu'])->group(function () {
        // Laporan Barang Masuk
        Route::resource('/admin/lap-barang-masuk', LapBarangMasukController::class)->except('store');
        Route::get('/admin/lapbarangmasuk/print/', [LapBarangMasukController::class, 'print'])->name('lap-bm.print');
        Route::get('/admin/lapbarangmasuk/pdf/', [LapBarangMasukController::class, 'pdf'])->name('lap-bm.pdf');
        Route::get('/admin/lap-barang-masuk/show/', [LapBarangMasukController::class, 'show'])->name('lap-bm.getlap-bm');
    });

    Route::middleware(['checkRoleUser:/lap-barang-keluar,submenu'])->group(function () {
        // Laporan Barang Keluar
        Route::resource('/admin/lap-barang-keluar', LapBarangKeluarController::class)->except('store');
        Route::get('/admin/lapbarangkeluar/print/', [LapBarangKeluarController::class, 'print'])->name('lap-bk.print');
        Route::get('/admin/lapbarangkeluar/pdf/', [LapBarangKeluarController::class, 'pdf'])->name('lap-bk.pdf');
        Route::get('/admin/lap-barang-keluar/show/', [LapBarangKeluarController::class, 'show'])->name('lap-bk.getlap-bk');
    });

    Route::middleware(['checkRoleUser:/lap-stok-barang,submenu'])->group(function () {
        // Laporan Stok Barang
        Route::resource('/admin/lap-stok-barang', LapStokBarangController::class)->except('store');
        Route::get('/admin/lapstokbarang/print/', [LapStokBarangController::class, 'print'])->name('lap-sb.print');
        Route::get('/admin/lapstokbarang/pdf/', [LapStokBarangController::class, 'pdf'])->name('lap-sb.pdf');
        Route::get('/admin/lap-stok-barang/show/', [LapStokBarangController::class, 'show'])->name('lap-sb.getlap-sb');
    });

    Route::middleware(['checkRoleUser:/lap-pemesanan-barang,submenu'])->group(function () {
        // Laporan Pemesanan Barang
        Route::resource('/admin/lap-pemesanan-barang', LapPemesananBarangController::class)->except('store');
        Route::get('/admin/lappemesananbarang/print/', [LapPemesananBarangController::class, 'print'])->name('lap-pb.print');
        Route::get('/admin/lappemesananbarang/pdf/', [LapPemesananBarangController::class, 'pdf'])->name('lap-pb.pdf');
        Route::get('/admin/lap-pemesanan-barang/show/', [LapPemesananBarangController::class, 'show'])->name('lap-pb.getlap-pb');
    });

    Route::middleware(['checkRoleUser:1,othermenu'])->group(function () {

        Route::middleware(['checkRoleUser:2,othermenu'])->group(function () {
            // Menu
            Route::resource('/admin/menu', MenuController::class);
            Route::post('/admin/menu/hapus', [MenuController::class, 'hapus']);
            Route::get('/admin/menu/sortup/{sort}', [MenuController::class, 'sortup']);
            Route::get('/admin/menu/sortdown/{sort}', [MenuController::class, 'sortdown']);
        });

        Route::middleware(['checkRoleUser:3,othermenu'])->group(function () {
            // Role
            Route::resource('/admin/role', RoleController::class);
            Route::get('/admin/role/show/', [RoleController::class, 'show'])->name('role.getrole');
            Route::post('/admin/role/hapus', [RoleController::class, 'hapus']);
        });

        Route::middleware(['checkRoleUser:4,othermenu'])->group(function () {
            // List User
            Route::resource('/admin/user', UserController::class);
            Route::get('/admin/user/show/', [UserController::class, 'show'])->name('user.getuser');
            Route::post('/admin/user/hapus', [UserController::class, 'hapus']);
        });

        Route::middleware(['checkRoleUser:5,othermenu'])->group(function () {
            // Akses
            Route::get('/admin/akses/{role}', [AksesController::class, 'index']);
            Route::get('/admin/akses/addAkses/{idmenu}/{idrole}/{type}/{akses}', [AksesController::class, 'addAkses']);
            Route::get('/admin/akses/removeAkses/{idmenu}/{idrole}/{type}/{akses}', [AksesController::class, 'removeAkses']);
            Route::get('/admin/akses/setAll/{role}', [AksesController::class, 'setAllAkses']);
            Route::get('/admin/akses/unsetAll/{role}', [AksesController::class, 'unsetAllAkses']);
        });

        Route::middleware(['checkRoleUser:/pemesanan-barang,submenu'])->group(function () {
            // Pemesanan Barang
            Route::resource('/admin/pemesanan-barang', PemesananBarangController::class)->except('store');
            Route::get('/admin/pemesanan-barang/show/', [PemesananBarangController::class, 'show'])->name('pemesanan-barang.getpemesanan-barang');
            Route::post('/admin/pemesanan-barang/proses_tambah/', [PemesananBarangController::class, 'proses_tambah'])->name('pemesanan-barang.store');
            Route::post('/admin/pemesanan-barang/proses_ubah/{pemesananbarang}', [PemesananBarangController::class, 'proses_ubah']);
            Route::post('/admin/pemesanan-barang/proses_hapus/{pemesananbarangx`}', [PemesananBarangController::class, 'proses_hapus']);
            Route::get('/admin/barang/getbarang/{id}', [BarangController::class, 'getbarang']);
            Route::get('/admin/barang/listbarang/{param}', [BarangController::class, 'listbarang']);
        });

        Route::middleware(['checkRoleUser:/konfirmasi-pemesanan,submenu'])->group(function () {
        //     // Konfirmasi Pemesanan
            Route::resource('/admin/konfirmasi-pemesanan', KonfirmasiPemesananController::class)->except('store');
            Route::get('/admin/konfirmasi-pemesanan/show/', [KonfirmasiPemesananController::class, 'show'])->name('konfirmasi-pemesanan.getpemesanan-barang');
            Route::post('/admin/konfirmasi-pemesanan/proses-konfirmasi', [KonfirmasiPemesananController::class, 'konfirmasiPemesanan'])->name('konfirmasi-pemesanan.konfirmasiPemesanan');
        //     Route::post('/admin/konfirmasi-pemesanan/proses_tambah/', [KonfirmasiBarangController::class, 'proses_tambah'])->name('konfirmasi-pemesanan.store');
        //     Route::post('/admin/konfirmasi-pemesanan/proses_ubah/{barangmasuk}', [KonfirmasiBarangController::class, 'proses_ubah']);
        //     Route::post('/admin/konfirmasi-pemesanan/proses_hapus/{barangmasuk}', [KonfirmasiBarangController::class, 'proses_hapus']);
        //     Route::get('/admin/barang/getbarang/{id}', [BarangController::class, 'getbarang']);
        //     // Route::get('/admin/barang/listbarang/{param}', [BarangController::class, 'listbarang']);
        });

        Route::middleware(['checkRoleUser:6,othermenu'])->group(function () {
            // Web
            Route::resource('/admin/web', WebController::class);
        });
    });
});

Route::get('/tes', function() {
    // COntoh ngambil barang id 2
    $data = BarangModel::with('jenisBarang')->findOrFail(2);
    // cara manggil relasinya sesuaikan dengan nama fungsi di model BarangModel
    // $data itu data di tabel barang
    // $data->jenisBarang itu data di tabel jenis barang yang terkoneksi sama tabel barang
    dd([
        "Kode Barang" => $data->barang_kode,
        "Nama Barang" => $data->barang_nama,
        "Semua Atribut Jenis Barang di Tabel Barang" => $data->jenisBarang,
        "Atribut Jenis Barang dari Barang datanya (nama)" => $data->jenisBarang->jenisbarang_nama,
        "Atribut Jenis Barang dari Barang datanya (slug)" => $data->jenisBarang->jenisbarang_slug,
    ]); 
});

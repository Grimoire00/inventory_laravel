<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\SupplierModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Admin\KonfirmasiPemesananModel;

class KonfirmasiPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["title"] = "Pemesanan Barang";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang', 'tbl_akses.akses_type' => 'create'))->count();
        $data["supplier"] = SupplierModel::orderBy('supplier_id', 'DESC')->get();
        return view('Admin.PemesananBarang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\KonfirmasiPemesananModel  $konfirmasiPemesananModel
     * @return \Illuminate\Http\Response
     */
    public function show(KonfirmasiPemesananModel $konfirmasiPemesananModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\KonfirmasiPemesananModel  $konfirmasiPemesananModel
     * @return \Illuminate\Http\Response
     */
    public function edit(KonfirmasiPemesananModel $konfirmasiPemesananModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\KonfirmasiPemesananModel  $konfirmasiPemesananModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KonfirmasiPemesananModel $konfirmasiPemesananModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\KonfirmasiPemesananModel  $konfirmasiPemesananModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(KonfirmasiPemesananModel $konfirmasiPemesananModel)
    {
        //
    }
}

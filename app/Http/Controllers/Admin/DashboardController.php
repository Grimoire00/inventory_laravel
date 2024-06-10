<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\BarangModel;
use App\Models\Admin\CustomerModel;
use App\Models\Admin\SupplierModel;
use App\Models\Admin\JenisBarangModel;
use App\Models\Admin\MerkModel;
use App\Models\Admin\RoleModel;
use App\Models\Admin\SatuanModel;
use App\Models\Admin\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $data["title"] = "Dashboard";
        $data["jenis"] = JenisBarangModel::orderBy('jenisbarang_id', 'DESC')->count();
        $data["satuan"] = SatuanModel::orderBy('satuan_id', 'DESC')->count();
        $data["merk"] = MerkModel::orderBy('merk_id', 'DESC')->count();
        $data["barang"] = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')->leftJoin('tbl_merk', 'tbl_merk.merk_id', '=', 'tbl_barang.merk_id')->orderBy('barang_id', 'DESC')->count();
        $data["customer"] = CustomerModel::orderBy('customer_id', 'DESC')->count();
        $data["supplier"] = SupplierModel::orderBy('supplier_id', 'DESC')->count();
        $data["bm"] = BarangmasukModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_barangmasuk.barang_id')->leftJoin('tbl_supplier', 'tbl_supplier.supplier_id', '=', 'tbl_barangmasuk.supplier_id')->orderBy('bm_id', 'DESC')->count();
        $data["bk"] = BarangkeluarModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_barangkeluar.barang_id')->orderBy('bk_id', 'DESC')->count();
        $data["user"] = UserModel::leftJoin('tbl_role', 'tbl_role.role_id', '=', 'tbl_user.role_id')->select()->orderBy('user_id', 'DESC')->count();
        return view('Admin.Dashboard.index', $data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangModel::orderBy('barang_id', 'DESC')
                ->get();

                $filteredData = $data->reject(function ($row) {
                    // dd($row);
                    $stokawal = $row->barang_stok;
                    $jmlmasuk = BarangmasukModel::where('barang_id', '=', $row->barang_id)->sum('bm_jumlah');
                    $jmlkeluar = BarangkeluarModel::where('barang_id', '=', $row->barang_id)->sum('bk_jumlah');
                    $totalstok = $stokawal + $jmlmasuk - $jmlkeluar;
                // dd($totalstok, $row->safety_stok);
                if ($totalstok < $row->min_stok || $totalstok < $row->safety_stok) {
                    return false;
                }else
                    return true;
                }); // Reset the keys after filtering
            // dd($filteredData);
            return DataTables::of($filteredData)
                ->addIndexColumn()
                // ->filter(function ($instance) {
                //     $instance->collection = $instance->collection->filter(function ($row) {
                //         dd($row);
                //         $stokawal = $row->barang_stok;                        
                //         $jmlmasuk = BarangmasukModel::where('barang_id', '=', $row->barang_id)->sum('bm_jumlah');
                //         $jmlkeluar = BarangkeluarModel::where('barang_id', '=', $row->barang_id)->sum('bk_jumlah');
                //         $totalstok = $stokawal + $jmlmasuk - $jmlkeluar;
    
                //         return $totalstok < $row->min_stok || $totalstok < $row->safety_stok;
                //     });
                // })
                ->addColumn('totalstok', function ($row) {
                    $stokawal = $row->barang_stok;
                    $jmlmasuk = BarangmasukModel::where('barang_id', '=', $row->barang_id)->sum('bm_jumlah');
                    $jmlkeluar = BarangkeluarModel::where('barang_id', '=', $row->barang_id)->sum('bk_jumlah');
                    $totalstok = $stokawal + $jmlmasuk - $jmlkeluar;
    
                    if ($totalstok < $row->min_stok) {
                        $result = '<span class="text-warning">'.$totalstok.'</span>';
                    } else if ($totalstok < $row->safety_stok) {
                        $result = '<span class="text-danger">'.$totalstok.'</span>';
                    } else {
                        $result = '<span class="text-success">'.$totalstok.'</span>';
                    }
    
                    return $result;
                })
                ->addColumn('average', function ($row) {
                    return $row->average == '' ? '-' : $row->average;
                })
                ->addColumn('min_permintaan', function ($row) {
                    return $row->min_permintaan == '' ? '-' : $row->min_permintaan;
                })
                ->addColumn('max_permintaan', function ($row) {
                    return $row->max_permintaan == '' ? '-' : $row->max_permintaan;
                })
                ->addColumn('leadtime', function ($row) {
                    return $row->leadtime == '' ? '-' : $row->leadtime;
                })
                ->addColumn('safety_stok', function ($row) {
                    return $row->safety_stok == '' ? '-' : $row->safety_stok;
                })
                ->addColumn('min_stok', function ($row) {
                    return $row->min_stok == '' ? '-' : $row->min_stok;
                })
                ->addColumn('max_stok', function ($row) {
                    return $row->max_stok == '' ? '-' : $row->max_stok;
                })
                ->rawColumns(['totalstok', 'average', 'leadtime', 'min_stok', 'max_stok', 'safety_stok'])
                ->make(true);
        }
    }
}

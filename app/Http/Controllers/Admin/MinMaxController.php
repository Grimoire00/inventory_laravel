<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AksesModel;
use App\Models\Admin\MinMaxModel;
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\BarangkeluarModel;
use App\Models\Admin\BarangModel;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MinMaxController extends Controller
{
    public function index()
    {
        $data["title"] = "Perhitungan Min-Max";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
            ->where([
                'tbl_akses.role_id' => Session::get('user')->role_id,
                'tbl_submenu.submenu_judul' => 'Barang',
                'tbl_akses.akses_type' => 'create'
            ])->count();
        return view('Admin.MinMax.index', $data);
    }

    public function getbarang($id)
    {
        $data = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')
            ->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')
            ->leftJoin('tbl_merk', 'tbl_merk.merk_id', '=', 'tbl_barang.merk_id')
            ->leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_barangmasuk.barang_id')
            ->leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_barangkeluar.barang_id')
            ->where('tbl_barang.barang_kode', '=', $id)->get();
        return json_encode($data);
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')
                ->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')
                ->leftJoin('tbl_merk', 'tbl_merk.merk_id', '=', 'tbl_barang.merk_id')
                ->orderBy('barang_id', 'DESC')->get();
    
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('totalstok', function ($row) use ($request) {
                    $stokawal = $row->barang_stok; // Ambil stok awal langsung dari row saat ini
                    $jmlmasuk = BarangmasukModel::where('barang_id', '=', $row->barang_id)->sum('bm_jumlah');
                    $jmlkeluar = BarangkeluarModel::where('barang_id', '=', $row->barang_id)->sum('bk_jumlah');
                    $totalstok = $stokawal + $jmlmasuk - $jmlkeluar;
        
                    if ($totalstok == 0) {
                        $result = '<span class="text-danger">'.$totalstok.'</span>';
                    } else if ($totalstok > 0) {
                        $result = '<span class="text-success">'.$totalstok.'</span>';
                    } else {
                        $result = '<span class="text-danger">'.$totalstok.'</span>';
                    }
        
                    return $result;
                })
                
                ->addColumn('average', function ($row) {
                    $average = $row->average == '' ? '-' : $row->average;
                    return $average;
                })
                
                ->addColumn('leadtime', function ($row) {
                    $leadtime = $row->leadtime == '' ? '-' : $row->leadtime;
                    return $leadtime;
                })
                
                ->addColumn('safety_stok', function ($row) {
                    $safety_stok = $row->safety_stok == '' ? '-' : $row->safety_stok;
                    return $safety_stok;
                })

                ->addColumn('min_stok', function ($row) {
                    $min_stok = $row->min_stok == '' ? '-' : $row->min_stok;
                    return $min_stok;
                })

                ->addColumn('max_stok', function ($row) {
                    $max_stok = $row->max_stok == '' ? '-' : $row->max_stok;
                    return $max_stok;
                })

                ->addColumn('action', function ($row) {
                    $array = array(
                        "barang_id" => $row->barang_id,
                        "jenisbarang_id" => $row->jenisbarang_id,
                        "satuan_id" => $row->satuan_id,
                        "merk_id" => $row->merk_id,
                        "barang_kode" => $row->barang_kode,
                        "barang_nama" => trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $row->barang_nama)),
                        "barang_harga" => $row->barang_harga,
                        "barang_stok" => $row->barang_stok,
                        "barang_gambar" => $row->barang_gambar,
                    );
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang', 'tbl_akses.akses_type' => 'update'))->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Barang', 'tbl_akses.akses_type' => 'delete'))->count();
                    if ($hakEdit > 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit > 0 && $hakDelete == 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        </div>
                        ';
                    } else if ($hakEdit == 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } else {
                        $button .= '-';
                    }

                    return $button;
                })
                ->rawColumns(['totalstok', 'average', 'leadtime', 'min_stok', 'max_stok', 'safety_stok', 'action'])
            ->make(true);
        }
    }

    public function proses_ubah(Request $request, BarangModel $minmax)
    {
        $hakTambah = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
            ->where([
                'tbl_akses.role_id' => Session::get('user')->role_id,
                'tbl_submenu.submenu_judul' => 'Barang',
                'tbl_akses.akses_type' => 'create'
            ])->count();
        // $data["title"] = "Perhitungan Min-Max";
        // $data= BarangModel::get();
        $data = BarangModel::leftJoin('tbl_jenisbarang', 'tbl_jenisbarang.jenisbarang_id', '=', 'tbl_barang.jenisbarang_id')
        ->leftJoin('tbl_satuan', 'tbl_satuan.satuan_id', '=', 'tbl_barang.satuan_id')
        ->leftJoin('tbl_merk', 'tbl_merk.merk_id', '=', 'tbl_barang.merk_id')
        ->orderBy('barang_id', 'DESC')->get();

        $data->map(function ($row) {
            $stokawal = $row->barang_stok; 
            $jmlmasuk = BarangmasukModel::where('barang_id', '=', $row->barang_id)->sum('bm_jumlah');
            $jmlkeluar = BarangkeluarModel::where('barang_id', '=', $row->barang_id)->sum('bk_jumlah');
            $totalstok = $stokawal + $jmlmasuk - $jmlkeluar;
        
            // Tambahkan atribut baru current_stock ke setiap objek row
            $row->current_stock = $totalstok;
        
            return $row;
        });
        // dd($data);
        $minmax->update([
            'min_stok' => $request->minStok,
            'max_stok' => $request->maxStok,
            'leadtime' => $request->leadtime,
            'average'   => $request->average,
            'safety_stok'   => $request->safety,
        ]);

        return view('Admin.MinMax.edit', ['data' => $data, 'title' => 'Perhitungan Min-Max', 'hakTambah' => $hakTambah] );
    }
}

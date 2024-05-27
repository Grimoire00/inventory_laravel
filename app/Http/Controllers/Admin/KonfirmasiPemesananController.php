<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\SupplierModel;

use App\Models\Admin\KonfirmasiPemesananModel;
use App\Models\Admin\PemesananBarangModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
class KonfirmasiPemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["title"] = "Konfirmasi Barang";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')->where(array('tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Konfirmasi Pemesanan', 'tbl_akses.akses_type' => 'create'))->count();
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
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $data = PemesananBarangModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_pemesanan.barang_id')
                ->leftJoin('tbl_supplier', 'tbl_supplier.supplier_id', '=', 'tbl_pemesanan.supplier_id')
                ->orderBy('pesan_id', 'DESC')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('tgl', function ($row) {
                    $tgl = $row->pesan_tanggal == '' ? '-' : Carbon::parse($row->pesan_tanggal)->translatedFormat('d F Y');
                    return $tgl;
                })
                ->addColumn('supplier', function ($row) {
                    $supplier = $row->supplier_id == '' ? '-' : $row->supplier_nama;
                    return $supplier;
                })
                ->addColumn('barang', function ($row) {
                    $barang = $row->barang_id == '' ? '-' : $row->barang_nama;
                    return $barang;
                })
                ->addColumn('pstatus', function ($row) {
                    $bg_color = '';
                    switch ($row->pesan_status) {
                        case 'PENDING':
                            $bg_color = 'bg-warning';
                            break;
                        case 'APPROVED':
                            $bg_color = 'bg-success';
                            break;
                        case 'REJECTED':
                            $bg_color = 'bg-danger';
                            break;
                        default:
                            $bg_color = 'bg-warning';
                            break;
                    }
                    return '<span class="badge ' . $bg_color . '">' . $row->pesan_status .  '</span>';
                })
                ->addColumn('action', function ($row) {
                    $array = [
                        "pesan_id" => $row->pesan_id,
                        "pesan_kode" => $row->pesan_kode,
                        "pesan_status" => $row->pesan_status,
                    ];
                    $arrayTolak = array_merge($array, ["action" => 'Tolak']);
                    $arrayTerima = array_merge($array, ["action" => 'Terima']);
                    $button = '<div class="g-2">
                        <a class="btn modal-effect btn-sm btn-danger" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Kmodaldemo9" onclick=konfirmasiPopupModal(' . json_encode($arrayTolak) . ')>Tolak</span></a>
                        <a class="btn modal-effect btn-sm btn-success" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Kmodaldemo9" onclick=konfirmasiPopupModal(' . json_encode($arrayTerima) . ')>Terima</a>
                    </div>';
                    return $button;
                })
                ->rawColumns(['action', 'tgl', 'supplier', 'barang', 'pstatus'])->make(true);
        }
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

    public function konfirmasiPemesanan(Request $request)
    {
        //
        // dd($request->all());
        $status = '';
        // AMbil data pemesanan dari model PemesananBarangModel
        $data = PemesananBarangModel::find($request->konfirmasi_pesanan_id);
        if ($request->konfirmasi_action === 'Terima') {
            $status = 'APPROVED';
        } else if ($request->konfirmasi_action === 'Tolak') {   
            $status = 'REJECTED';
        } else {
            $status = 'PENDING';
        }
        $data->update([
            'pesan_status' => $status,
        ]);
        return redirect()->route('konfirmasi-pemesanan.index')->with('success', 'Data pemesanan ' . $data->pesan_kode . ' Berhasil di update');
        // return response()->json(['status' => 'success', 'message' => 'Data pemesanan ' . $data->pesan_kode . ' Berhasilahkan']);
    }
}
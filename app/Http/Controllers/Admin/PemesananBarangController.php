<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AksesModel;
use App\Models\Admin\BarangmasukModel;
use App\Models\Admin\BarangModel;
use App\Models\Admin\CustomerModel;
use App\Models\Admin\PemesananBarangModel;
use App\Models\Admin\SupplierModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class PemesananBarangController extends Controller
{
    public function index()
    {
        $data["title"] = "Pemesanan Barang";
        $data["hakTambah"] = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
            ->where(['tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Pemesanan Barang', 'tbl_akses.akses_type' => 'create'])
            ->count();
        $data["supplier"] = SupplierModel::orderBy('supplier_id', 'DESC')->get();
        return view('Admin.PemesananBarang.index', $data);
    }

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
                        "barang_id" => $row->barang_id,
                        "barang_kode" => $row->barang_kode,
                        "supplier_id" => $row->supplier_id,
                        "pesan_tanggal" => date('Y-m-d', strtotime($row->pesan_tanggal)),
                        "pesan_jumlah" => $row->pesan_jumlah
                    ];
                    $button = '';
                    $hakEdit = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where(['tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Pemesanan Barang', 'tbl_akses.akses_type' => 'update'])
                        ->count();
                    $hakDelete = AksesModel::leftJoin('tbl_submenu', 'tbl_submenu.submenu_id', '=', 'tbl_akses.submenu_id')
                        ->where(['tbl_akses.role_id' => Session::get('user')->role_id, 'tbl_submenu.submenu_judul' => 'Pemesanan Barang', 'tbl_akses.akses_type' => 'delete'])
                        ->count();
                    if ($hakEdit > 0 && $hakDelete > 0) {
                        $button .= '
                        <div class="g-2">
                        <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        <a class="btn modal-effect text-danger btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Hmodaldemo8" onclick=hapus(' . json_encode($array) . ')><span class="fe fe-trash-2 fs-14"></span></a>
                        </div>
                        ';
                    } elseif ($hakEdit > 0 && $hakDelete == 0) {
                        $button .= '
                        <div class="g-2">
                            <a class="btn modal-effect text-primary btn-sm" data-bs-effect="effect-super-scaled" data-bs-toggle="modal" href="#Umodaldemo8" data-bs-toggle="tooltip" data-bs-original-title="Edit" onclick=update(' . json_encode($array) . ')><span class="fe fe-edit text-success fs-14"></span></a>
                        </div>
                        ';
                    } elseif ($hakEdit == 0 && $hakDelete > 0) {
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
                ->rawColumns(['action', 'tgl', 'supplier', 'barang', 'pstatus'])->make(true);
        }
    }

    public function proses_tambah(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'pbkode' => 'required|string',
        //     'tglpesan' => 'required|date',
        //     'supplier' => 'required|exists:tbl_supplier,supplier_id',
        //     'kdbarang' => 'required|exists:tbl_barang,barang_kode',
        //     'qty' => 'required|numeric|min:1',
        //     'totalharga' => 'required|numeric|min:1',
        // ]);

        $barang = BarangModel::where('barang_kode', $request->barang)->first();
        // dd($barang);

        PemesananBarangModel::create([
            'pesan_tanggal' => $request->tglpesan,
            'pesan_kode' => $request->pbkode,
            'barang_id' => $barang->barang_id,
            'barang_kode' => $request->barang,
            'supplier_id' => $request->supplier,
            'pesan_jumlah' => $request->pesan_jumlah,
            'pesan_totalharga' => $request->totalharga,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function getCustomerAlamat($customer_id)
    {
        $customer = CustomerModel::find($customer_id);
        if ($customer) {
            return response()->json(['success' => true, 'alamat' => $customer->customer_alamat]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function proses_ubah(Request $request, PemesananBarangModel $pemesananbarang)
    {
        $request->validate([
            'pbkode' => 'required|string',
            'tglpesan' => 'required|date',
            'supplier' => 'required|exists:tbl_supplier,supplier_id',
            'kdbarang' => 'required|exists:tbl_barang,barang_kode',
            'qty' => 'required|numeric|min:1',
            'totalharga' => 'required|numeric|min:1',
        ]);

        $pemesananbarang->update([
            'pesan_tanggal' => $request->tglpesan,
            'barang_kode' => $request->kdbarang,
            'supplier_id' => $request->supplier,
            'pesan_jumlah' => $request->qty,
            'pesan_totalharga' => $request->totalharga,
        ]);

        return response()->json(['success' => 'Berhasil']);
    }

    public function proses_hapus(Request $request, PemesananBarangModel $pemesananbarang)
    {
        $pemesananbarang->delete();

        return response()->json(['success' => 'Berhasil']);
    }
}
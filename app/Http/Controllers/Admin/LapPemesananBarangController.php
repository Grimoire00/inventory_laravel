<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin\PemesananBarangModel;
use App\Models\Admin\WebModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LapPemesananBarangController extends Controller
{
    public function index(Request $request)
    {
        $data["title"] = "Lap Pemesanan Barang";
        return view('Admin.Laporan.PemesananBarang.index', $data);
    }

    public function print(Request $request)
    {
        if ($request->tglawal) {
            $data['data'] = PemesananBarangModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_pemesanan.pesan_id')->leftJoin('tbl_supplier', 'tbl_supplier.supplier_id', '=', 'tbl_pemesanan.pesan_id')->whereBetween('pesan_tanggal', [$request->tglawal, $request->tglakhir])->orderBy('pesan_id', 'DESC')->get();
        } else {
            $data['data'] = PemesananBarangModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_pemesanan.pesan_id')->leftJoin('tbl_supplier', 'tbl_supplier.supplier_id', '=', 'tbl_pemesanan.pesan_id')->orderBy('pesan_id', 'DESC')->get();
        }

        $data["title"] = "Print Pemesanan Barang";
        $data['web'] = WebModel::first();
        $data['tglawal'] = $request->tglawal;
        $data['tglakhir'] = $request->tglakhir;
        return view('Admin.Laporan.PemesananBarang.print', $data);
    }

    public function pdf(Request $request)
    {
        if ($request->tglawal) {
            $data['data'] = PemesananBarangModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_pemesanan.barang_id')->leftJoin('tbl_supplier', 'tbl_supplier.supplier_id', '=', 'tbl_pemesanan.supplier_id')->whereBetween('pesan_tanggal', [$request->tglawal, $request->tglakhir])->orderBy('pesan_id', 'DESC')->get();
        } else {
            $data['data'] = PemesananBarangModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_pemesanan.barang_id')->leftJoin('tbl_supplier', 'tbl_supplier.supplier_id', '=', 'tbl_pemesanan.supplier_id')->orderBy('pesan_id', 'DESC')->get();
        }

        $data["title"] = "PDF Pemesanan Barang";
        $data['web'] = WebModel::first();
        $data['tglawal'] = $request->tglawal;
        $data['tglakhir'] = $request->tglakhir;
        $pdf = Pdf::loadView('Admin.Laporan.PemesananBarang.pdf', $data);
        
        if($request->tglawal){
            return $pdf->download('lap-pb-'.$request->tglawal.'-'.$request->tglakhir.'.pdf');
        }else{
            return $pdf->download('lap-pb-semua-tanggal.pdf');
        }
        
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tglawal == '') {
                $data = PemesananBarangModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_pemesanan.barang_id')->leftJoin('tbl_supplier', 'tbl_supplier.supplier_id', '=', 'tbl_pemesanan.supplier_id')->orderBy('pesan_id', 'DESC')->get();
            } else {
                $data = PemesananBarangModel::leftJoin('tbl_barang', 'tbl_barang.barang_id', '=', 'tbl_pemesanan.barang_id')->leftJoin('tbl_supplier', 'tbl_supplier.supplier_id', '=', 'tbl_pemesanan.supplier_id')->whereBetween('pesan_tanggal', [$request->tglawal, $request->tglakhir])->orderBy('pesan_id', 'DESC')->get();
            }
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
                ->addColumn('status', function ($row) {
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
                            $bg_color = 'bg-secondary';
                            break;
                    }
                    return '<span class="badge ' . $bg_color . '">' . $row->pesan_status . '</span>';
                })
                ->rawColumns(['tgl', 'supplier', 'barang', 'status'])->make(true);
        }
    }
}
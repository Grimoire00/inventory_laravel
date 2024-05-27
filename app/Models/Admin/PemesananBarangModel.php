<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananBarangModel extends Model
{
    use HasFactory;

    protected $table = "tbl_pemesanan";
    protected $primaryKey = 'pesan_id';
    protected $fillable = [
        'barang_id',
        'pesan_kode',
        'pesan_jumlah',
        'barang_kode',
        'supplier_id',
        'pesan_totalharga',
        'pesan_tanggal',
        'pesan_status',
    ]; 

    public function tbl_supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id', 'supplier_id');
    }
    public function tbl_barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }
}
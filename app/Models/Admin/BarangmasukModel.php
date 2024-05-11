<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangmasukModel extends Model
{
    use HasFactory;
    protected $table = "tbl_barangmasuk";
    protected $primaryKey = 'bm_id';
    protected $fillable = [
        'bm_kode',
        'barang_id',
        'barang_kode',
        'supplier_id',
        'bm_tanggal',
        'bm_jumlah',
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

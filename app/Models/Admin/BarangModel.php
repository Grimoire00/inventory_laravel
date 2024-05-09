<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;
    protected $table = "tbl_barang";
    protected $primaryKey = 'barang_id';
    protected $fillable = [
        'jenisbarang_id',
        'satuan_id',
        'merk_id',
        'barang_kode',
        'barang_nama',
        'barang_slug',
        'barang_harga',
        'barang_stok',
        'barang_gambar',
    ];
    
    public function jenisBarang(): BelongsTo
    {
        return $this->belongsTo(JenisBarangModel::class, 'jenisbarang_id', 'jenisbarang_id');
    }

    public function tbl_satuan()
    {
        return $this->belongsTo(SatuanModel::class, 'satuan_id', 'satuan_id');
    }

    public function tbl_merk()
    {
        return $this->belongsTo(MerkModel::class, 'merk_id', 'merk_id');
    }
}

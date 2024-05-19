<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;
    protected $table = "tbl_supplier";
    protected $primaryKey = 'supplier_id';
    protected $fillable = [
        'supplier_nama',
        'supplier_slug',
        'supplier_alamat',
        'supplier_notelp',
    ]; 

    public function barangmasuks(): HasMany
    {
        return $this->hasMany(BarangmasukModel::class, 'bm_id', 'bm_id');
    }
    public function pemesanans(): HasMany
    {
        return $this->hasMany(PemesananBarangModel::class, 'pesan_id', 'pesan_id');
    }
}

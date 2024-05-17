<?php

namespace App\Models;

use App\Models\Admin\BarangkeluarModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MinMaxModel extends Model
{
    use HasFactory;
    protected $table = "tbl_minmax";
    protected $primaryKey = 'mm_id';
    protected $fillable = [
        'mm_periode',
        'mm_min',
        'mm_max',
        'mm_average',
        'mm_leadtime',
        'mm_safety',
        'mm_reorderpoin'
    ];
    public function barangs(): HasOne
    {
        return $this->hasOne(BarangkeluarModel::class, 'barang_id', 'barang_id');
    }
}

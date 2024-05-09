<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatuanModel extends Model
{
    use HasFactory;
    protected $table = "tbl_satuan";
    protected $primaryKey = 'satuan_id';
    protected $fillable = [
        'satuan_nama',
        'satuan_slug',
        'satuan_keterangan'
    ];

    public function satuans(): HasMany
    {
        return $this->hasMany(SatuanModel::class, 'satuan_id', 'satuan_id');
    }
}

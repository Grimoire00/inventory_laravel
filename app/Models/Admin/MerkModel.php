<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerkModel extends Model
{
    use HasFactory;
    protected $table = "tbl_merk";
    protected $primaryKey = 'merk_id';
    protected $fillable = [
        'merk_nama',
        'merk_slug',
        'merk_keterangan'
    ]; 
    
    public function merks(): HasMany
    {
        return $this->hasMany(MerkModel::class, 'merk_id', 'merk_id');
    }
}

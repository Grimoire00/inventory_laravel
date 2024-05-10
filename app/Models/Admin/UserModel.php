<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = "tbl_user";
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'role_id',
        'user_nama',
        'user_nmlengkap',
        'user_email',
        'user_password',
        'user_foto',
    ];

    public function tbl_role()
    {
        return $this->belongsTo(RoleModel::class, 'role_id', 'role_id');
    }

    public function appreances(): HasMany
    {
        return $this->hasMany(AppreanceModel::class, 'appreance_id', 'appreance_id');
    }
    public function barangs(): HasMany
    {
        return $this->hasMany(BarangModel::class, 'barang_id', 'barang_id');
    }
}

<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;
    protected $table = "tbl_role";
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_title',
        'role_slug',
        'role_desc'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(UserModel::class, 'user_id', 'user_id');
    }
    public function aksess(): HasMany
    {
        return $this->hasMany(AksesModel::class, 'akses_id', 'akses_id');
    }
}

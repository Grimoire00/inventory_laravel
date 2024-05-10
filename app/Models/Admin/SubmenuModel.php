<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmenuModel extends Model
{
    use HasFactory;
    protected $table = "tbl_submenu";
    protected $primaryKey = 'submenu_id';
    protected $fillable = [
        'menu_id',
        'submenu_judul',
        'submenu_slug',
        'submenu_redirect',
        'submenu_sort'
    ];

    public function menus(): HasMany
    {
        return $this->hasMany(MenuModel::class, 'menu_id', 'menu_id');
    }
    public function aksess(): HasMany
    {
        return $this->hasMany(AksesModel::class, 'submenu_id', 'submenu_id');
    }

}

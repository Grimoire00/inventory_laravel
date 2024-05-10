<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = "tbl_menu";
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'menu_id',
        'menu_judul',
        'menu_slug',
        'menu_icon',
        'menu_redirect',
        'menu_sort',
        'menu_type'
    ]; 

    public function tbl_submenu()
    {
        return $this->belongsTo(SubmenuModel::class, 'submenu_id', 'submenu_id');
    }
    public function aksess(): HasMany
    {
        return $this->hasMany(AksesModel::class, 'akses_id', 'akses_id');
    }
}

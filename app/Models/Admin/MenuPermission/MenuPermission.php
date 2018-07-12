<?php

namespace App\Models\Admin\MenuPermission;

use Illuminate\Database\Eloquent\Model;

class MenuPermission extends Model
{
    //

	protected $table = 'menu_permissions';

    protected $fillable = ['menu_id','designation_id','create','edit','delete','view'];
}

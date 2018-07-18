<?php

namespace App\Models\Admin\ItemType;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    //
    //protected $table = "item_type";
    protected $fillable = ['item_category_id', 'item_type'];
}

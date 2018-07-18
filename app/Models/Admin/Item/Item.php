<?php

namespace App\Models\Admin\Item;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = ['item_name', 'item_code', 'item_image', 'item_category_id', 'item_type_id', 'item_description', 'vendor_id'];
}

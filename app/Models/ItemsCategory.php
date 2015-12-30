<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsCategory extends Model {

    protected $table = 'items_category';
    protected $primaryKey = 'item_category_id';
    protected $guarded = ['item_category_id'];

}
?>

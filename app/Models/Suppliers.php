<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model {

    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    protected $guarded = ['supplier_id'];

}
?>

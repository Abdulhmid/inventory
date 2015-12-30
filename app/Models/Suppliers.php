<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model {

    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    protected $guarded = ['supplier_id'];

	public function item() {
			return $this->hasMany(Items::class, 'supplier_id', 'supplier_id');
	}

	public function scopeTakeData(){
		return self::orderBy('supplier_id','desc')->get();
	}

}
?>

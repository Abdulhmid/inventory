<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model {

    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

	public function detail() {
		return $this->belongsTo(ItemDetail::class, 'item_id', 'id');
	}

	public function price() {
		return $this->belongsTo(ItemPrice::class, 'item_id', 'id');
	}

	public function supplier() {
		return $this->belongsTo(Suppliers::class, 'supplier_id', 'supplier_id');
	}

}
?>

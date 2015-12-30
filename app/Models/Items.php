<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model {

    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

	public function detail() {
		return $this->belongsTo(ItemDetail::class, 'id', 'item_id');
	}

	public function price() {
		return $this->belongsTo(ItemPrice::class, 'id', 'item_id');
	}

	public function supplier() {
		return $this->belongsTo(Suppliers::class, 'supplier_id', 'supplier_id');
	}

    /**
     * Validation Users CRUD
     */
    public static $rules = array(
        'supplier_id' => 'required',
        'category_id' => 'required',
        'name_item'   => 'required',
        'price_buy'	  => 'required',
        'price_selling'	  => 'required',
        'stok'	  		=> 'required',
        'note'			=> 'required'
    );

}
?>

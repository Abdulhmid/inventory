<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPrice extends Model {

	protected $table = 'items_price';
	protected $primaryKey = 'item_price_id';
	protected $guarded = ['item_price_id'];

	public function item() {
		return $this->hasOne(Items::class, 'item_id', 'id');
	}

}

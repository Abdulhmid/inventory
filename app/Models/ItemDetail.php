<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model {

	protected $table = 'items_detail';
	protected $primaryKey = 'item_detail_id';
	protected $guarded = ['item_detail_id'];

	public function item() {
		return $this->hasOne(Items::class, 'item_id', 'id');
	}

}

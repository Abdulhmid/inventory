<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionSell extends Model {

    protected $table = 'transaction_sell';
    protected $primaryKey = 'transaction_sell_id';
    public $timestamps = true;
    protected $guarded = ['transaction_sell_id'];

	public function item() {
		return $this->hasOne(Items::class, 'id', 'item_id');
	}

}
?>

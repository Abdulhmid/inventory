<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionBuy extends Model {

    protected $table = 'transaction_buy';
    protected $primaryKey = 'transaction_buy_id';
    public $timestamps = true;
    protected $guarded = ['transaction_buy_id'];

	public function item() {
		return $this->hasOne(Items::class, 'id', 'item_id');
	}

	public function scopeTakeData(){
		return self::with('item')->select('*')
								 // ->groupBy('key_transaction')
								 ->orderBy('transaction_buy_id','desc')->get();
	}

}
?>

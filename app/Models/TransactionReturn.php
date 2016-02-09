<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionReturn extends Model {

    protected $table = 'transaction_return';
    protected $primaryKey = 'transaction_return_id';
    public $timestamps = true;
    protected $guarded = ['transaction_return_id'];

	public function item() {
		return $this->hasOne(Items::class, 'id', 'item_id');
	}

	public function scopeTakeData(){
		return self::with('item')->select('*')
								 ->orderBy('transaction_return_id','desc')->get();
	}

}
?>

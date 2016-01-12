<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionBuy extends Model {

    protected $table = 'transaction_buy';
    protected $primaryKey = 'transaction_buy_id';
    protected $guarded = ['transaction_buy_id'];

}
?>

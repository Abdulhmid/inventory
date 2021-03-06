<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSellTransaction extends Migration
{
    protected $table = "transaction_sell";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable($this->table)) {

          Schema::create($this->table, function (Blueprint $table) {

              /** Primary key  */
              $table->increments('transaction_sell_id');

              /** Main data  */
              $table->integer('qty');
              $table->decimal('price_sell',10,2);
              $table->text('expedition')->nullable();
              $table->string('key_transaction');

              /* Action */

              /* Relastio */
              $table->integer('item_id')->unsigned();

              $table->foreign('item_id')->references('id')
                ->on('items')->onDelete('cascade')
                ->onUpdate('cascade');
                
              $table->timestamps();
          });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}

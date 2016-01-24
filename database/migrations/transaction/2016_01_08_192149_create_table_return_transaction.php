<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReturnTransaction extends Migration
{
    protected $table = "transaction_return";
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
              $table->increments('transaction_return_id');

              /** Main data  */
              $table->integer('qty');
              $table->decimal('cost_return',10,2);
              $table->text('description');

              /* Action */

              /* Relastio */
              $table->integer('item_id')->unsigned();
              $table->foreign('item_id')->references('id')
                ->on('items')->onDelete('cascade')
                ->onUpdate('cascade');

              $table->integer('transaction_buy_id')->unsigned();
              $table->foreign('transaction_buy_id')->references('transaction_buy_id')
                ->on('transaction_buy')->onDelete('cascade')
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

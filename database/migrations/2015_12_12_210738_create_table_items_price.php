<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItemsPrice extends Migration
{
    protected $table = "items_price";
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
              $table->increments('item_price_id');

              /** Main data  */
              $table->decimal('price',19,2);

              /* Action */
              $table->nullableTimestamps();

              /* Relastio */
              $table->integer('item_id')->unsigned();

              $table->foreign('item_id')->references('id')
                ->on('items')->onDelete('cascade')
                ->onUpdate('cascade');
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

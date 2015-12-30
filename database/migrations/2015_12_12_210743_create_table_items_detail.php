<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItemsDetail extends Migration
{
    protected $table = "items_detail";
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
              $table->increments('item_detail_id');

              /** Main data  */
              $table->text('note');

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

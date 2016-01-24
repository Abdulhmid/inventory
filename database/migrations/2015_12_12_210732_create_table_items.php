<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItems extends Migration
{
    protected $table = "items";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable($this->table)) {

          Schema::create($this->table, function (Blueprint $table) {
              $table->engine = 'InnoDB';
              /** Primary key  */
              $table->increments('id');

              /** Main data  */
              $table->string('name_items', 255);

              /* Action */
              $table->nullableTimestamps();

              /* Relation */
              $table->integer('category_id')->unsigned();
              $table->integer('supplier_id')->unsigned();

              $table->foreign('category_id')->references('item_category_id')
                ->on('items_category')->onDelete('cascade')
                ->onUpdate('cascade');
              $table->foreign('supplier_id')->references('supplier_id')
                ->on('suppliers')->onDelete('cascade')
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategoryItems extends Migration
{
    protected $table = "items_category";
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
              $table->increments('item_category_id');

              /** Main data  */
              $table->string('name_category', 255);
              $table->text('description')->nullable();

              /* Action */
              $table->nullableTimestamps();
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

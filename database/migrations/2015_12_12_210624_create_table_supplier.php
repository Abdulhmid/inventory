<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSupplier extends Migration
{
    protected $table = "suppliers";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable($this->table)) {
          Schema::create($this->table, function (Blueprint $table) {
              $table->increments('menu_id');
              $table->integer('parent_id');
              $table->string('menu_name');
              $table->string('menu_type','60');
              $table->string('telp');
              $table->string('email');
              $table->string('website');
              $table->text('photo')->nullable();
              $table->tinyInteger('allow_guest')->default(0);
              $table->tinyInteger('active')->default(0);

              $table->string('created_by')->default('system');
              $table->softDeletes();
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

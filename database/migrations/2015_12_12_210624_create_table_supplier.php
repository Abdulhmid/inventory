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
              $table->increments('supplier_id');
              $table->string('name_company');
              $table->string('address');
              $table->string('handphone','60');
              $table->string('telp');
              $table->string('email');
              $table->string('website');
              $table->text('photo')->nullable();
              $table->tinyInteger('active')->default(0);

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

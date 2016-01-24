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
              $table->engine = 'InnoDB';
              $table->increments('supplier_id');
              $table->string('name_company');
              $table->string('handphone');
              $table->string('telp','60');
              $table->string('email');
              $table->string('website');
              $table->tinyInteger('active')->default(0);
              $table->string('photo')->nullable();
              $table->text('address')->nullable();

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

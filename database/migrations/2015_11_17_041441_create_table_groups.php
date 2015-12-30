<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('groups')) {

            Schema::create('groups', function (Blueprint $table) {

                /** Primary key  */
                $table->increments('group_id');

                /** Main data  */
                $table->string('group_name', 255);
                $table->text('description')->nullable();
                $table->integer('order')->nullable();

                /* Action */
                $table->nullableTimestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('groups');
    }
}

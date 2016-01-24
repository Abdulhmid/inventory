<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('id',36)->primary();
                $table->string('username');
                $table->string('email');
                $table->string('password','60');
                $table->string('name');
                $table->text('photo')->nullable();
                $table->rememberToken();
                $table->tinyInteger('active')->default(0);

                $table->softDeletes();
                $table->timestamp('last_login')->nullable();
                $table->timestamps();

                /*
                ** Relation
                */
                $table->integer('group_id')->unsigned();
                $table->foreign('group_id')->references('group_id')->on('groups')
          				->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('users');
    }
}

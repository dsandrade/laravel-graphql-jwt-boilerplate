<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::enableForeignKeyConstraints();
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('username');
                $table->string('email');
                $table->string('password');
                $table->string('image');
                $table->unsignedInteger('role_id');
                $table->rememberToken();
                $table->timestamps();

                $table->foreign('role_id')->references('id')->on('roles');

                $table->index('username');
                $table->index('email');
                $table->index('role_id');
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

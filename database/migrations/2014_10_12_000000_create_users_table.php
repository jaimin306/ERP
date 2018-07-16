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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->text('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('website');
            $table->string('department_id');
            $table->string('designation_id');
            $table->string('last_ip');
            $table->datetime('last_login');
            $table->rememberToken();
            $table->timestamps();
        });
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

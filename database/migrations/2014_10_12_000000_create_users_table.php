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
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->increments('id');
                $table->bigInteger('username')->unique();
                $table->string('password'); //year-month-day 1990-01-01
                $table->string('api_token', 60)->unique();
                $table->enum('level', [0, 1, 2])->default(1);
                $table->string('name');
                $table->integer('bus_no');
                $table->string('dept_id');
                $table->string('course_id')->default('undefined');
                $table->enum('semester', [1, 2, 3, 4])->nullable();
                $table->string('avatar');
                $table->date('registered_on');
                $table->bigInteger('phone_no')->unique();
            }
        );
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

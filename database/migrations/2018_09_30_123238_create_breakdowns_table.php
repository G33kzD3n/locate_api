<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreakdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breakdowns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bus_no');
            $table->string('type');
            $table->text('message')->nullable();
            $table->timestamps();
            $table->foreign('bus_no')->references('bus_no')->on('buses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breakdowns');
    }
}

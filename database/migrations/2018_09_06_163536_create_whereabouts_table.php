<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhereaboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whereabouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bus_no');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->timestamps();
            $table->boolean('status')->default(0);
            $table->foreign('bus_no')
                ->references('bus_no')->on('buses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whereabouts');
    }
}

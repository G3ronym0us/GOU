<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteTravelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_travel', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('travel_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->decimal('origin_lat', 10, 8)->nullable();
            $table->decimal('origin_lng', 11, 8)->nullable();
            $table->decimal('destiny_lat', 11, 8)->nullable();
            $table->decimal('destiny_lng', 11, 8)->nullable();
            $table->bigInteger('km');
            $table->timestamps();

            $table->foreign('travel_id')->references('id')->on('travels');
            $table->foreign('driver_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');

            //2
            $table->boolean('isarrived')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_travel');
    }
}

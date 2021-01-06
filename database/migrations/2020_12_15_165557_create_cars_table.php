<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('model_id')->unsigned();
            $table->string('car_year');
            $table->string('car_color');
            $table->string('car_patent');
            $table->date('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('model_id')->references('id')->on('model_cars');

            $table->bigInteger('type_vehicle_id')->unsigned();
            $table->foreign('type_vehicle_id')->references('id')->on('type_vehicles');

            //4
            $table->string('duration',255)->nullable()->default("0");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}

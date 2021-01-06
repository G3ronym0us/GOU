<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_drivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('travel_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->double('last_balance')->nullable();
            $table->double('actual_balance')->nullable();
            $table->boolean('in')->nullable();
            $table->boolean('out')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->foreign('travel_id')->references('id')->on('travels');
            $table->foreign('driver_id')->references('id')->on('drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_drivers');
    }
}

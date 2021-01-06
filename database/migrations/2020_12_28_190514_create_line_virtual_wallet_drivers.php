<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineVirtualWalletDrivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_virtual_wallet_drivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('virtual_wallet_driver_id')->unsigned();
            $table->boolean('entry')->nullable();
            $table->boolean('egress')->nullable();
            $table->boolean('inprocess')->nullable();
            $table->boolean('paid')->nullable();
            $table->double('total_driver');
            $table->double('commission');
            $table->double('total');
            $table->timestamps();

            $table->foreign('virtual_wallet_driver_id')->references('id')->on('virtual_wallet_drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('line_virtual_wallet_drivers');
    }
}

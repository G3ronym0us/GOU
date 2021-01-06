<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('travel_id')->unsigned();
            $table->bigInteger('qualifier_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('rate')->default(1);
            $table->timestamps();

            
            $table->foreign('travel_id')->references('id')->on('travels');
            $table->foreign('qualifier_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rate_clients');
    }
}

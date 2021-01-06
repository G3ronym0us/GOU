<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('travel_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->double('last_balance')->nullable();
            $table->double('actual_balance')->nullable();
            $table->boolean('in')->nullable();
            $table->boolean('out')->nullable();
            $table->text('reason')->nullable();
            $table->timestamps();

                        
            $table->foreign('travel_id')->references('id')->on('travels');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balance_users');
    }
}

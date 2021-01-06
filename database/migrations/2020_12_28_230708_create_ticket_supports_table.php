<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_supports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('travel_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('admin_id')->unsigned();
            $table->boolean('driver')->nullable();
            $table->integer('status')->default(1);
            $table->text('description')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('admin_id')->references('id')->on('users');
            $table->foreign('travel_id')->references('id')->on('travels');

            //2
            $table->boolean('read')->nullable();

            //3
            $table->boolean('readAdmin')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_supports');
    }
}

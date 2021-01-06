<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_supports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ticket_support_id')->unsigned();
            $table->text('message');
            $table->boolean('user')->nullable();
            $table->boolean('admin')->nullable();
            $table->timestamps();

            $table->foreign('ticket_support_id')->references('id')->on('ticket_supports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_supports');
    }
}

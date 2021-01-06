<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('license')->nullable();
            $table->string('license_img')->nullable();
            $table->string('carlicense')->nullable();
            $table->string('carlicense_img')->nullable();
            $table->string('insuranse')->nullable();
            $table->string('insuranse_img')->nullable();
            $table->string('vtv')->nullable();
            $table->string('vtv_img')->nullable();
            $table->string('front_img')->nullable();
            $table->string('back_img')->nullable();
            $table->string('left_img')->nullable();
            $table->string('right_img')->nullable();
            $table->date('deleted_at')->nullable();
            $table->boolean('license_status')->nullable()->default(0);
            $table->boolean('carlicense_status')->nullable()->default(0);
            $table->boolean('insuranse_status')->nullable()->default(0);
            $table->boolean('vtv_status')->nullable()->default(0);
            $table->boolean('front_status')->nullable()->default(0);
            $table->boolean('back_status')->nullable()->default(0);
            $table->boolean('left_status')->nullable()->default(0);
            $table->boolean('right_status')->nullable()->default(0);
            $table->timestamps();

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
        Schema::dropIfExists('documentations');
    }
}

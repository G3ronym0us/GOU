<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('car_id')->unsigned()->nullable();
            $table->bigInteger('documentation_id')->unsigned()->nullable();
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->boolean('validated')->nullable();
            $table->boolean('in_travel')->nullable();
            $table->boolean('offline')->nullable()->default(true);
            $table->boolean('banned')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('documentation_id')->references('id')->on('documentations');

            //3
            $table->double('total_commission')->nullable();
            $table->double('total_paid')->nullable();

            //4
            $table->boolean('viewed')->nullable()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}

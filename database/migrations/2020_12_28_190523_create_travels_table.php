<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('driver_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->boolean('paid')->nullable();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->text('details')->nullable();
            $table->string('start_address');
            $table->string('stop_address');
            $table->bigInteger('distance');
            $table->decimal('start_lat', 10, 8)->nullable();
            $table->decimal('start_lng', 11, 8)->nullable();
            $table->decimal('stop_lat', 11, 8)->nullable();
            $table->decimal('stop_lng', 11, 8)->nullable();
            $table->double('price_base');
            $table->double('price_km');
            $table->double('price_time');
            $table->double('total');
            $table->double('final_total')->nullable();
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');

            $table->bigInteger('line_virtual_wallet_driver_id')->unsigned();

            $table->foreign('line_virtual_wallet_driver_id')->references('id')->on('line_virtual_wallet_drivers');

            //4
            $table->boolean('cc')->nullable()->default(false);

            //5
            $table->boolean('received')->nullable()->default(false);

            //6
            $table->boolean('waypointed')->nullable();

            //7
            $table->string('photoDelivery')->nullable();
            $table->string('commentsDelivery')->nullable();

            //8
            $table->dateTime('driverarrivedtime')->nullable();

            //9
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('color')->nullable();
            $table->string('patent')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travels');
    }
}

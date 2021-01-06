<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_prices', function (Blueprint $table) {
            $table->id();
            $table->double('base_price');
            $table->double('price_km');
            $table->double('price_min');
            $table->integer('limit_km');
            $table->timestamps();

            //2
            $table->float('value_delivery')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_prices');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_routes', function (Blueprint $table) {
            $table->id();
            $table->text('price')->nullable();
            $table->text('processing_time')->nullable();
            $table->text('shipping_time')->nullable();
            $table->unsignedBigInteger('origin_city_id')->nullable();
            $table->unsignedBigInteger('destination_city_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_routes');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFulfillmentLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fulfillment_line_items', function (Blueprint $table) {
            $table->id();
            $table->integer('fulfilled_quantity')->nullable();
            $table->unsignedBigInteger('order_fulfillment_id')->nullable();
            $table->unsignedBigInteger('order_line_item_id')->nullable();
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
        Schema::dropIfExists('fulfillment_line_items');
    }
}

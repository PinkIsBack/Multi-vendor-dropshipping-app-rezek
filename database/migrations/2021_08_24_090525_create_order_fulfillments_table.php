<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderFulfillmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_fulfillments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_order_id')->nullable();
            $table->text('name')->nullable();
            $table->text('status')->nullable();
            $table->text('tracking_url')->nullable();
            $table->text('tracking_number')->nullable();
            $table->text('tracking_notes')->nullable();
            $table->text('fulfillment_shopify_id')->nullable();
            $table->text('admin_fulfillment_shopify_id')->nullable();
            $table->text('tracking_company')->nullable();
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
        Schema::dropIfExists('order_fulfillments');
    }
}

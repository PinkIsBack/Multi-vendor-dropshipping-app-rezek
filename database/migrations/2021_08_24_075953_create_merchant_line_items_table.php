<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantLineItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_line_items', function (Blueprint $table) {
            $table->id();

            $table->text('merchant_order_id')->nullable(); //link line item with order
            $table->text('merchant_product_variant_id')->nullable(); //link with merchant product variant
            $table->text('shopify_product_id')->nullable();
            $table->text('shopify_variant_id')->nullable();
            $table->text('title')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('variant_title')->nullable();
            $table->string('sku')->nullable();
            $table->string('vendor')->nullable();
            $table->string('price')->nullable();
            $table->string('fulfilled_by')->nullable();

            $table->string('requires_shipping')->nullable();
            $table->boolean('taxable')->nullable();
            $table->string('name')->nullable();
            $table->text('properties')->nullable();

            $table->integer('fulfillable_quantity')->nullable();
            $table->string('fulfillment_status')->nullable();
            $table->double('cost')->nullable();
            $table->unsignedBigInteger('dropship_variant_id')->nullable();
            $table->unsignedBigInteger('linked_product_id')->nullable();
            $table->unsignedBigInteger('linked_variant_id')->nullable();
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
        Schema::dropIfExists('merchant_line_items');
    }
}

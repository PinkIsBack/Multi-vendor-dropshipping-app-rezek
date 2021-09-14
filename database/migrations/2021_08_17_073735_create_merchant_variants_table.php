<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_variants', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('option1')->nullable();
            $table->text('option2')->nullable();
            $table->text('option3')->nullable();
            $table->text('price')->nullable();
            $table->text('compare_price')->nullable();
            $table->text('cost')->nullable();
            $table->text('quantity')->nullable();
            $table->text('sku')->nullable();
            $table->text('barcode')->nullable();
            $table->text('image')->nullable();
            $table->text('shopify_id')->nullable();
            $table->text('inventory_item_id')->nullable();
            $table->text('is_dropship_variant')->nullable();
            $table->unsignedInteger('shop_id')->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
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
        Schema::dropIfExists('merchant_variants');
    }
}

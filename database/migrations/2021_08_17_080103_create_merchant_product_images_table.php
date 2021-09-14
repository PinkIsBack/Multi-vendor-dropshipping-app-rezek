<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_product_images', function (Blueprint $table) {
            $table->id();
            $table->text('position')->nullable();
            $table->boolean('isV')->default(0)->nullable();
            $table->text('shopify_id')->nullable();
            $table->text('src')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('shop_id')->nullable();
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
        Schema::dropIfExists('merchant_product_images');
    }
}

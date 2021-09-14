<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->text('position')->nullable();
            $table->text('alt')->nullable();
            $table->text('width')->nullable();
            $table->text('height')->nullable();
            $table->text('src')->nullable();
            $table->text('isV')->nullable();
            $table->bigInteger('variant_id')->unsigned()->nullable();
            $table->bigInteger('shop_id')->nullable()->unsigned();
            $table->bigInteger('product_id')->nullable()->unsigned();
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
        Schema::dropIfExists('product_images');
    }
}

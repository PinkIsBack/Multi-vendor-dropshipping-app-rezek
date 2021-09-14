<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->text('title')->nullable();
            $table->longText('description')->nullable();

            $table->longText('images')->nullable();

            $table->text('type')->nullable();
            $table->text('vendor')->nullable();
            $table->text('tags')->nullable();

            $table->text('cost')->nullable();
            $table->text('price')->nullable();
            $table->text('compare_price')->nullable();
            $table->text('quantity')->nullable();
            $table->text('weight')->nullable();
            $table->text('sku')->nullable();
            $table->text('barcode')->nullable();
            $table->text('length')->nullable();
            $table->text('width')->nullable();
            $table->text('height')->nullable();

            $table->text('variants')->nullable();
            $table->text('attribute1')->nullable();
            $table->text('attribute2')->nullable();
            $table->text('attribute3')->nullable();
            $table->longText('option1')->nullable();
            $table->longText('option2')->nullable();
            $table->longText('option3')->nullable();
            $table->longText('featured_image')->nullable();

            $table->text('status')->nullable();
            $table->text('import_count')->nullable();
            $table->bigInteger('admin_status')->unsigned()->nullable();
            $table->bigInteger('supplier_id')->nullable()->unsigned();
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
        Schema::dropIfExists('products');
    }
}

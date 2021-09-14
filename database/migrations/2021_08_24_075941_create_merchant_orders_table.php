<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_orders', function (Blueprint $table) {
            $table->id();

            $table->string('shopify_order_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('shopify_created_at')->nullable();
            $table->timestamp('shopify_updated_at')->nullable();
            $table->text('note')->nullable();
            $table->string('name')->nullable();
            $table->double('total_price')->nullable();
            $table->double('subtotal_price')->nullable();
            $table->double('total_weight')->nullable();
            $table->double('total_tax')->nullable();
            $table->boolean('taxes_included')->nullable();
            $table->string('currency')->nullable();
            $table->double('total_discounts')->nullable();
            $table->text('customer')->nullable();
            $table->text('billing_address')->nullable();
            $table->text('shipping_address')->nullable();
            $table->boolean('paid')->default(0);
            $table->text('status')->nullable();
            $table->text('fulfilled_by')->nullable();
            $table->boolean('sync_status')->nullable(1);
            $table->double('cost_to_pay')->nullable();
            $table->unsignedInteger('shop_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->text('shipping_price')->nullable();
            $table->text('admin_shopify_id')->nullable();
            $table->text('admin_shopify_name')->nullable();
            $table->text('financial_status')->nullable();
            $table->text('delivery_status')->nullable();
            $table->text('transit_time')->nullable();
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
        Schema::dropIfExists('merchant_orders');
    }
}

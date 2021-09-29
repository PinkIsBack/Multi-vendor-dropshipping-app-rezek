<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transactions', function (Blueprint $table) {
            $table->id();
            $table->text('note')->nullable();
            $table->double('amount')->nullable();
            $table->text('name')->nullable();
            $table->text('payment_id')->nullable();
            $table->text('card_last_four')->nullable();
            $table->unsignedBigInteger('merchant_order_id')->nullable();
            $table->unsignedBigInteger('shop_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('order_transactions');
    }
}

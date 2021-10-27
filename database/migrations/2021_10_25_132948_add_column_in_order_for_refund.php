<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInOrderForRefund extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->boolean('refund_request')->default(0)->nullable();
            $table->boolean('is_refunded')->default(0)->nullable();
            $table->text('refund_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->dropColumn('refund_request');
            $table->dropColumn('is_refunded');
            $table->dropColumn('refund_note');
        });
    }
}

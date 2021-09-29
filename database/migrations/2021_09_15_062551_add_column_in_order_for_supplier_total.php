<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInOrderForSupplierTotal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_orders', function (Blueprint $table) {
            $table->boolean('is_supplier')->default(0)->nullable();
            $table->string('supplier_price')->default(0)->nullable();
            $table->string('commission')->default(0)->nullable();
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
            $table->dropColumn('is_supplier');
            $table->dropColumn('supplier_price');
            $table->dropColumn('commission');
        });
    }
}

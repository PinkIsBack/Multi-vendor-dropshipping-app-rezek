<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommissionColumnInMerchantProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_products', function (Blueprint $table) {
            $table->string('margin')->nullable()->default(0);
            $table->string('supplier_price')->nullable()->default(0);
            $table->string('supplier_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('merchant_products', function (Blueprint $table) {
            $table->dropColumn('margin');
            $table->dropColumn('supplier_price');
            $table->dropColumn('supplier_id');
        });
    }
}

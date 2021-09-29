<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierPriceColumnInlineItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('merchant_line_items', function (Blueprint $table) {
            $table->string('supplier_price')->default(0)->nullable();
            $table->string('margin')->default(0)->nullable();
            $table->string('is_supplier_fulfill')->default(0)->nullable();
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
        Schema::table('merchant_line_items', function (Blueprint $table) {
            $table->dropColumn('supplier_price');
            $table->dropColumn('margin');
            $table->dropColumn('is_supplier_fulfill');
            $table->dropColumn('supplier_id');
        });
    }
}

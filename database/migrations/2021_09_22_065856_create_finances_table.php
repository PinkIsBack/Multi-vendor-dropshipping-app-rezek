<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('order_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('no_products')->nullable();
            $table->string('cost_products')->nullable()->default(0);
            $table->string('cost_shipping')->nullable()->default(0);
            $table->string('paid_at')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_paid')->nullable()->default(0);
            $table->boolean('status')->nullable()->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finances');
    }
}

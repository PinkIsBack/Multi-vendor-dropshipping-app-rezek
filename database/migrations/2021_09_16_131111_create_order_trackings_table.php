<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('courier_name')->nullable();
            $table->string('courier_code')->nullable();
            $table->string('number')->nullable();
            $table->string('url')->nullable();
            $table->string('cost_shipping')->nullable()->default(0);
            $table->text('note')->nullable();
            $table->boolean('status')->default(0)->nullable();
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
        Schema::dropIfExists('order_trackings');
    }
}

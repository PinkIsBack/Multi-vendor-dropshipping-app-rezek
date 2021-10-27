<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletedShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_id')->nullable();
            $table->string('shop_domain')->nullable();
            $table->string('user_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('deleted_shops');
    }
}

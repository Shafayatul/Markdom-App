<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->nullable();
            $table->string('product_ids')->nullable();
            $table->longText('order_details')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('total_price')->nullable();
            $table->string('discount')->nullable();
            $table->integer('order_status_id')->nullable();
            $table->string('image')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('delivery_time')->nullable();
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
        Schema::dropIfExists('driver_orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('order_details')->nullable();
            $table->string('user_id')->nullable();
            $table->string('cart_ids')->nullable();
            $table->string('total_price')->nullable();
            $table->string('address_id')->nullable();
            $table->string('final_price')->nullable();
            $table->string('order_status_id')->nullable();
            $table->string('image')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('estimated_time')->nullable();
            $table->string('paytab_transation_id')->nullable();
            $table->string('smsa_awab_number')->nullable();
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
        Schema::drop('orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestuarentCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restuarent_customer_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->string('store_id')->nullable();
            $table->longText('order_details')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('offer_price')->nullable();
            $table->string('image')->nullable();
            $table->string('is_accepted')->default(0);
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
        Schema::drop('restuarent_customer_orders');
    }
}

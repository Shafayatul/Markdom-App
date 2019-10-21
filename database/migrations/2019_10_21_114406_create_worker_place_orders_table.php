<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerPlaceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_place_orders', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('user_id')->nullable();
            $table->integer('address_id')->nullable();
            $table->integer('schedule_time_id')->nullable();
            $table->integer('service_type_id')->nullable();
            $table->string('cart_ids')->nullable();
            $table->string('total_price')->nullable();
            $table->string('final_price')->nullable();
            $table->string('order_status_id')->nullable();
            $table->string('estimated_time')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('discount_percent')->nullable();
            $table->string('promo_code')->nullable();
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
        Schema::dropIfExists('worker_place_orders');
    }
}

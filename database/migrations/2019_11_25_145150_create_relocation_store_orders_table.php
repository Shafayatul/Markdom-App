<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelocationStoreOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relocation_store_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('car_type_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->string('lat1')->nullable();
            $table->string('lng1')->nullable();
            $table->string('lat2')->nullable();
            $table->string('lng2')->nullable();
            $table->string('price')->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('paytab_transaction_id')->nullable();
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
        Schema::dropIfExists('relocation_store_orders');
    }
}

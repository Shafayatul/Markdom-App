<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgainTwoFieldsToRestuarentCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restuarent_customer_orders', function (Blueprint $table) {
            $table->string('food_cost')->nullable();
            $table->string('delivery_charge')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restuarent_customer_orders', function (Blueprint $table) {
            $table->dropColumn('food_cost');
            $table->dropColumn('delivery_charge');
        });
    }
}

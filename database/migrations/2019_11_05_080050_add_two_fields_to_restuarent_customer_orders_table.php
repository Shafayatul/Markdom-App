<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoFieldsToRestuarentCustomerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restuarent_customer_orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable();
            $table->string('paytab_transaction_id')->nullable();
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
            $table->dropColumn('payment_method');
            $table->dropColumn('paytab_transaction_id');
        });
    }
}

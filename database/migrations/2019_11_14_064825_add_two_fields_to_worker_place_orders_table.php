<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoFieldsToWorkerPlaceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker_place_orders', function (Blueprint $table) {
            $table->string('payment_method')->nullable();
            $table->string('paytab_transaction_id')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('worker_place_orders', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->dropColumn('paytab_transaction_id');
            $table->dropColumn('image');
        });
    }
}

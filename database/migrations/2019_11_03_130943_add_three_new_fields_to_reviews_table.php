<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThreeNewFieldsToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('driver_id')->nullable();
            $table->integer('restaurent_customer_order_id')->nullable();
            $table->integer('worker_place_order_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('driver_id');
            $table->dropColumn('restaurent_customer_order_id');
            $table->dropColumn('worker_place_order_id');
        });
    }
}

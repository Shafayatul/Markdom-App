<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewThreeFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_offer')->nullable();
            $table->string('offer_type')->nullable();
            $table->integer('offer_amount')->nullable();
            $table->integer('offer_percent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_offer');
            $table->dropColumn('offer_type');
            $table->dropColumn('offer_amount');
            $table->dropColumn('offer_percent');
        });
    }
}

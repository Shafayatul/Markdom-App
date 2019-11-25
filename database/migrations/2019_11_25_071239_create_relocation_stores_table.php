<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelocationStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relocation_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('name_arabic')->nullable();
            $table->string('description')->nullable();
            $table->string('arabic_description')->nullable();
            $table->string('preview_image')->nullable();
            $table->string('multiple_images')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('status')->nullable();
            $table->string('store_owner_id')->nullable();
            $table->string('location')->nullable();
            $table->string('arabic_location')->nullable();
            $table->string('module_id')->nullable();
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
        Schema::drop('relocation_stores');
    }
}

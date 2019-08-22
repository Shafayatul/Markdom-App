<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('name_arabic')->nullable();
            $table->longText('description')->nullable();
            $table->string('preview_image')->nullable();
            $table->string('multiple_images')->nullable();
            $table->string('lat')->nullable();
            $table->string('lan')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::drop('stores');
    }
}

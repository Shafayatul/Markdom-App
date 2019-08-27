<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('name_arabic')->nullable();
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
        Schema::drop('schedule_types');
    }
}

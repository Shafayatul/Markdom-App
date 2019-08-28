<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookedSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booked_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('schedule_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('date')->nullable();
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
        Schema::drop('booked_schedules');
    }
}

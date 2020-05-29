<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpecialDatetime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_datetime', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('time_slot_id')->nullable();
            $table->string('time_slot_name')->nullable();
            $table->date('date');
            $table->integer('increase_price');
            $table->tinyInteger('status')->comment('1: hoat dong, 0: nghi');
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
        Schema::drop('special_datetime');
    }
}

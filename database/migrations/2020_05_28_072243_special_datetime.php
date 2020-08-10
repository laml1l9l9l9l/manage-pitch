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
            $table->integer('id_time_slot')->nullable()->unsigned();
            $table->foreign('id_time_slot')->references('id')->on('time_slots');
            $table->string('name_time_slot')->nullable();
            $table->date('date')->nullable();
            $table->foreign('date')->references('date')->on('dates');
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

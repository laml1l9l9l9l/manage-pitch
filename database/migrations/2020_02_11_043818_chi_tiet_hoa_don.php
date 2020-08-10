<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChiTietHoaDon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bill')->unsigned();
            $table->foreign('id_bill')->references('id')->on('bills');
            $table->integer('id_time_slot')->unsigned()->comment('ma khung gio');
            $table->foreign('id_time_slot')->references('id')->on('time_slots');
            $table->date('soccer_day')->comment('ngay da');
            $table->foreign('soccer_day')->references('date')->on('dates');
            $table->integer('id_pitch')->unsigned()->comment('ma san bong');
            $table->foreign('id_pitch')->references('id')->on('pitchs');
            $table->integer('price')->comment('gia');
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
        Schema::drop('detail_bills');
    }
}

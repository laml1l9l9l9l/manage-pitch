<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KhungGioDatLich extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->increments('id');
            $table->time('time_start')->comment('gio bat dau');
            $table->time('time_end')->comment('gio ket thuc');
            $table->string('name');
            $table->tinyInteger('time_special')->comment('1: them tien, 0: binh thuong');
            $table->integer('increase_price')->comment('gia tang');
            $table->tinyInteger('status')->comment('1: hoat dong, 0: khoa');
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
        Schema::drop('time_slots');
    }
}

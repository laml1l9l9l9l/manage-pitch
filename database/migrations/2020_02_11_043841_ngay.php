<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ngay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->string('id');
            $table->date('date');
            $table->string('name');
            $table->string('date_special')->comment('1: ngay dac biet, 0: ngay binh thuong');
            $table->string('increase_price')->comment('gia tang');
            $table->string('status')->comment('1: hoat dong, 0: nghi');
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
        Schema::drop('dates');
    }
}

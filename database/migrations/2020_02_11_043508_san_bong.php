<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SanBong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitchs', function (Blueprint $table) {
            $table->increments('id')->comment('ma san bong');
            $table->string('name');
            $table->tinyInteger('type')->comment('1: san 7, 2: san 9, 3: san 11');
            $table->tinyInteger('status')->comment('1: hoat dong, 0: khoa');
            $table->integer('price');
            $table->string('image');
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
        Schema::drop('pitchs');
    }
}

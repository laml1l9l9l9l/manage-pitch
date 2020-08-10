<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BillHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bill')->unsigned();
            $table->foreign('id_bill')->references('id')->on('bills');
            $table->integer('id_admin')->nullable()->unsigned();
            $table->foreign('id_admin')->references('id')->on('admins');
            $table->string('log_change')->nullable();
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
        Schema::drop('bill_history');
    }
}

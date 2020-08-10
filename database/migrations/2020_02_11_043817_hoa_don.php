<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HoaDon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('down_payment')->comment('tien dat coc');
            $table->integer('into_money')->comment('thanh tien');
            $table->tinyInteger('status')->comment('1: da thanh toan, 0: da dat coc, -1: chua dat coc');
            $table->tinyInteger('type')->default(1)->comment('1: kich hoat, 0: huy');
            $table->integer('id_customer')->unsigned();
            $table->foreign('id_customer')->references('id')->on('customers');
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
        Schema::drop('bills');
    }
}

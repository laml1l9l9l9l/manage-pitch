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
            $table->integer('id_bill');
            $table->integer('id_pitch')->comment('ma san bong');
            $table->integer('id_time_slot')->comment('ma khung gio');
            $table->string('soccer_day')->comment('ngay da');
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

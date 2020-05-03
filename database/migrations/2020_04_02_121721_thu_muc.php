<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThuMuc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('icon')->nullable()->comment('icon cho menu cha/ ten rut gon menu con');
            $table->string('link')->nullable();
            $table->string('level_menu')->nullable()->comment('0: khong co menu con, 1: co menu con');
            $table->string('index_menu')->nullable()->comment('sap xep thu tu menu');
            $table->string('index_sub_menu')->nullable()->comment('sap xep thu tu menu con');
            $table->string('link_relevant_menu')->nullable()->comment('link menu lien quan (danh cho menu an)');
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
        Schema::drop('menu');
    }
}

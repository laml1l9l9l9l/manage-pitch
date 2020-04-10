<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoLuongTonKho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantity_inventory', function (Blueprint $table) {
            $table->string('month')->comment('thang san pham con lai');
            $table->string('year');
            $table->string('id_product');
            $table->string('name_product');
            $table->string('quantity')->comment('so luong san pham con lai');
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
        Schema::drop('quantity_inventory');
    }
}

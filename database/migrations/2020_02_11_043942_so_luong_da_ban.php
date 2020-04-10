<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoLuongDaBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantity_sold', function (Blueprint $table) {
            $table->string('date')->comment('ngay ban san pham');
            $table->string('id_product');
            $table->string('name_product');
            $table->string('quantity')->comment('so luong san pham da ban');
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
        Schema::drop('quantity_sold');
    }
}

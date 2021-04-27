<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_products', function (Blueprint $table) {
            $table->id('id_order_product');
             $table->foreignId('id_order')->nullable()->index();
            $table->foreignId('id_product')->nullable()->index();
            $table->timestamps();
        });

        Schema::table('orders_products', function($table) {
            $table->foreign('id_product')->references('id_product')->on('products');
        });

        Schema::table('orders_products', function($table) {
            $table->foreign('id_order')->references('id_order')->on('orders');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_products');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsPriceLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_price_log', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->integer('price_store');
            $table->integer('price_olshop');
            $table->integer('discount_store');
            $table->integer('discount_olshop');
            $table->blameable();
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
        Schema::dropIfExists('products_price_log');
    }
}

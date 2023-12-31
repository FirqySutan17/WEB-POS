<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrTransactionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_transaction_detail', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('product_code');
            $table->integer('quantity');
            $table->integer('basic_price');
            $table->integer('discount');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_transaction_detail');
    }
}

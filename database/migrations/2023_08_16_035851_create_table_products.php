<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->longText('code')->unique();
            $table->string('name');
            $table->longText('description');
            $table->integer('price_store');
            $table->integer('price_olshop');
            $table->integer('stock_store');
            $table->integer('stock_olshop');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->blameable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

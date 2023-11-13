<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPoDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_tbl_po_detail', function (Blueprint $table) {
            $table->id();
            $table->string('no_po');
            $table->string('product_code');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->integer('amount');
            $table->integer('tax_amount');
            $table->integer('total_amount');
            $table->timestamps();
            $table->blameable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_tbl_po_detail');
    }
}

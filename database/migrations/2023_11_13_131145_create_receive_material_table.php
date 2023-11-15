<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_material', function (Blueprint $table) {
            $table->id();
            $table->string('no_receive');
            $table->string('plant');
            $table->string('no_po');
            $table->date('date_receive');
            $table->time('time_receive');
            $table->integer('supplier_id');
            $table->integer('top_days');
            $table->integer('top_category');
            $table->date('top_date');
            $table->string('supplier_invoice');
            $table->boolean('is_tax');
            $table->boolean('is_po');
            $table->integer('grand_qty');
            $table->integer('grand_amount');
            $table->integer('grand_total_tax');
            $table->integer('grand_total_amount');
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
        Schema::dropIfExists('receive_material');
    }
}

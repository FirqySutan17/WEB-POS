<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_tbl_po', function (Blueprint $table) {
            $table->id();
            $table->string('plant');
            $table->string('no_po');
            $table->date('date_po');
            $table->time('time_po');
            $table->integer('supplier_id');
            $table->integer('top_days');
            $table->integer('top_category');
            $table->date('top_date');
            $table->string('delivery_time');
            $table->string('delivery_place');
            $table->string('remarks');
            $table->boolean('is_tax')->default(0);
            $table->boolean('is_po')->default(0);
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
        Schema::dropIfExists('mst_tbl_po');
    }
}

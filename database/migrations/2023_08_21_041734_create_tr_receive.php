<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrReceive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_receive', function (Blueprint $table) {
            $table->id();
            $table->string('receive_code')->unique();
            $table->date('receive_date');
            $table->string('delivery_number');
            $table->text('delivery_file');
            $table->string('plate_no')->nullable();
            $table->string('driver')->nullable();
            $table->string('driver_phone')->nullable();
            $table->blameable();
            $table->softDeletes();
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
        Schema::dropIfExists('tr_receive');
    }
}

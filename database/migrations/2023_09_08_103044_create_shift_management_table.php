<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_management', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('seq');
            $table->string('employee_id');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('begin');
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
        Schema::dropIfExists('shift_management');
    }
}

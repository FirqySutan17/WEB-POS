<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstCommonCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_common_code', function (Blueprint $table) {
            $table->id();
            $table->string('head');
            $table->string('code');
            $table->string('code_name');
            $table->longText('description')->nullable();
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('mst_common_code');
    }
}

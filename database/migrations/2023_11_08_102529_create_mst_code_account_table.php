<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstCodeAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_code_account', function (Blueprint $table) {
            $table->id();
            $table->string('account_code');
            $table->integer('lvl');
            $table->string('account_name');
            $table->string('remark');
            $table->string('type');
            $table->integer('categories');
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
        Schema::dropIfExists('mst_code_account');
    }
}

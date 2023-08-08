<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('portfolio_id');
            $table->unsignedBigInteger('skill_id');

            $table->foreign('portfolio_id')->references('id')->on('portfolio')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('skill')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_skill');
    }
}

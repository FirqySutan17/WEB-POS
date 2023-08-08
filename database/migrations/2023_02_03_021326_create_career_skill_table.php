<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('career_id');
            $table->unsignedBigInteger('skill_id');

            $table->foreign('career_id')->references('id')->on('career')->onDelete('cascade');
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
        Schema::dropIfExists('career_skill');
    }
}

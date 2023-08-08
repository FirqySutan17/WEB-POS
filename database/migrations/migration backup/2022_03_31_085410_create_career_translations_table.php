<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedInteger('career_id');
            $table->unique(['career_id', 'locale']);
            $table->foreign('career_id')->references('id')->on('career_careers')->onDelete('cascade');

            // Actual fields you want to translate
            $table->longText('job_description');
            $table->longText('job_desk');
            $table->longText('job_requirements');
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
        Schema::dropIfExists('career_translations');
    }
}

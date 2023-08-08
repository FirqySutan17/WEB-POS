<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('project_slug')->unique();
            $table->integer('project_seq');
            $table->string('project_thumbnail');
            $table->string('project_cover');
            $table->string('project_gd');
            $table->string('project_cs');
            $table->string('project_photographer');
            $table->string('project_pm');
            $table->string('project_wd');
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
        Schema::dropIfExists('project_projects');
    }
}

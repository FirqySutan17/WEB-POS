<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id'); // Laravel 5.8+ use bigIncrements() instead of increments()
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('project_category_id');
            $table->unique(['project_category_id', 'locale']);
            $table->foreign('project_category_id')->references('id')->on('project_categories')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('category_title');
            $table->string('category_slug')->unique();
            $table->longText('category_desc');
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
        Schema::dropIfExists('project_category_translations');
    }
}

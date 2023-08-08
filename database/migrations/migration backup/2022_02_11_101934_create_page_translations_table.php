<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale');

            $table->unsignedBigInteger('meta_page_id');
            $table->unique(['meta_page_id', 'locale']);
            $table->foreign('meta_page_id')->references('id')->on('page_metas')->onDelete('cascade');


            $table->string('page_name');
            $table->string('page_slug');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword');
            $table->string('meta_robots');
            $table->string('og_title');
            $table->string('og_site_name');
            $table->string('og_description');
            $table->string('og_url');
            $table->string('og_image');
            $table->string('og_image_width');
            $table->string('og_image_height');
            $table->string('og_image_type')->nullable();
            $table->string('og_type');
            $table->string('og_locale');
            $table->string('og_locale_alternate');
            $table->string('twitter_card');
            $table->string('twitter_title');
            $table->string('twitter_description');
            $table->string('twitter_image');
            $table->string('twitter_creator');
            $table->string('twitter_site');
            $table->longText('schema_markup');

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
        Schema::dropIfExists('page_translations');
    }
}

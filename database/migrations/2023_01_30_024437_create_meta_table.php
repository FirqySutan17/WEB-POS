<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
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
            $table->string('og_type');
            $table->string('og_locale');
            $table->string('og_alternate');
            $table->string('twitter_card');
            $table->string('twitter_title');
            $table->string('twitter_description');
            $table->string('twitter_image');
            $table->string('twitter_creator');
            $table->string('twitter_site');
            $table->string('schema_markup');

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
        Schema::dropIfExists('meta');
    }
}

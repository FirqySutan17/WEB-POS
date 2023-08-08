<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_name');
            $table->string('team_slug')->unique();
            $table->integer('team_seq');
            $table->string('team_image');
            $table->string('team_position');
            $table->string('team_facebook');
            $table->string('team_twitter');
            $table->string('team_instagram');
            $table->string('team_linkedin');

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
        Schema::dropIfExists('team');
    }
}

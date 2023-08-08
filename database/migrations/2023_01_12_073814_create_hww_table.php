<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHwwTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hww', function (Blueprint $table) {
            $table->id();
            $table->integer('seq');
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('image');
            $table->string('alt_text');
            
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
        Schema::dropIfExists('hww');
    }
}

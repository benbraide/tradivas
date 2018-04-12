<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageThemeUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_theme_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theme_id')->length(10)->unsigned();
            $table->string('page');
            $table->integer('bg_color_start_proportion');
            $table->timestamps();
            $table->foreign("theme_id")->references("id")->on("themes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_theme_updates');
    }
}

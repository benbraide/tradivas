<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('theme_id')->length(10)->unsigned();
            $table->string('images_base', 100);
            $table->string('default_path', 100);
            $table->string('default_image', 100);
            $table->string('logo', 100);
            $table->timestamps();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->foreign("theme_id")->references("id")->on("themes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

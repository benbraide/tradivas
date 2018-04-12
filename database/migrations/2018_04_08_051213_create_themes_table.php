<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bg_color_start');
            $table->string('bg_color_stop');
            $table->integer('bg_color_start_proportion');
            $table->string('bg_rule_color');
            $table->string('bg_rule_width');
            $table->string('bg_rule_style');
            $table->string('btn_bg_color');
            $table->string('btn_bg_hilite_color');
            $table->string('btn_color');
            $table->string('btn_hilite_color');
            $table->string('input_outline_color');
            $table->string('top_menu_color');
            $table->string('top_menu_hilite_color');
            $table->string('menu_color');
            $table->string('menu_hilite_color');
            $table->string('footer_header_color');
            $table->string('footer_header_size');
            $table->string('footer_link_size');
            $table->string('footer_link_color');
            $table->string('footer_link_hilite_color');
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
        Schema::dropIfExists('themes');
    }
}

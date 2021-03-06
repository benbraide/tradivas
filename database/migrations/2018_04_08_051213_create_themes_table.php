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
            $table->string('name', 128);
            $table->string('bg_color_start', 128);
            $table->string('bg_color_stop', 128);
            $table->string('bg_color_start_proportion', 10);
            $table->string('bg_rule_color', 128);
            $table->string('bg_rule_width', 10);
            $table->string('bg_rule_style', 20);
            $table->string('btn_bg_color', 128);
            $table->string('btn_bg_hilite_color', 128);
            $table->string('btn_color', 128);
            $table->string('btn_hilite_color', 128);
            $table->string('input_outline_color', 128);
            $table->string('top_menu_color', 128);
            $table->string('top_menu_hilite_color', 128);
            $table->string('menu_color', 128);
            $table->string('menu_hilite_color', 128);
            $table->string('footer_header_color', 128);
            $table->string('footer_header_size', 10);
            $table->string('footer_link_size', 10);
            $table->string('footer_link_color', 128);
            $table->string('footer_link_hilite_color', 128);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->length(10)->unsigned();
            $table->integer('color_id')->length(10)->unsigned();
            $table->integer('size_id')->length(10)->unsigned();
            $table->integer('count');
            $table->timestamps();
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->foreign("item_id")->references("id")->on("items")->onDelete('cascade');
            $table->foreign("color_id")->references("id")->on("colors");
            $table->foreign("size_id")->references("id")->on("sizes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}

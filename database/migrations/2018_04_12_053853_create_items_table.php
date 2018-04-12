<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sku_id')->length(10)->unsigned();
            $table->decimal('price');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign("sku_id")->references("id")->on("skus")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}

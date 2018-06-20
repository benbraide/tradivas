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
            $table->decimal('base_price');
            $table->decimal('price');
            $table->string('title');
            $table->text('description');
            $table->integer('category');
            $table->integer('sub_category');
            $table->string('serial', 100);
            $table->integer('featured');
            $table->integer('sold');
            $table->boolean('numeric_size');
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
        Schema::dropIfExists('items');
    }
}

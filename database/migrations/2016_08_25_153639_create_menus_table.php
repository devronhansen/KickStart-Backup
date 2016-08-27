<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->text('vollkost');
            $table->text('vegetarisch');
            $table->text('fitness');
            $table->text('nachtisch');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('menus');
    }
}

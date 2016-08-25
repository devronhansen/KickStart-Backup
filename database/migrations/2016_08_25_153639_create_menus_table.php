<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->dateTime('date')->primary;
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

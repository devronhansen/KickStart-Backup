<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('edited_by')->unsigned();
            $table->foreign('edited_by')->references('id')->on('users');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('times');
    }
}

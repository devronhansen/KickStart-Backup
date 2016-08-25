<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferdetailsTable extends Migration
{
    public function up()
    {
        Schema::create('offer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->integer('offerid')->unsigned();
            $table->foreign('offerid')->references('id')->on('offers');
            $table->integer('edited_by')->unsigned();
            $table->foreign('edited_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('offer_details');
    }
}

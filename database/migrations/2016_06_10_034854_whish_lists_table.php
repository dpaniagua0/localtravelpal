<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WhishListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whish_lists', function($table){
            $table->bigIncrements('id');

            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');


            $table->bigInteger('destination_id')->unsigned();
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');

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
        //
    }
}

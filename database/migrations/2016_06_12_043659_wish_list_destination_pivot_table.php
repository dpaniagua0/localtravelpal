<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WishListDestinationPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_lists_destination', function($table){
            
            $table->bigInteger('destination_id')->unsigned();
            $table->foreign('destination_id')->references('id')
            ->on('destinations')->onDelete('cascade');

            $table->bigInteger('wish_list_id')->unsigned();
            $table->foreign('wish_list_id')->references('id')
            ->on('wish_lists')->onDelete('cascade');
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

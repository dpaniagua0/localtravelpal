<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveDestinationIdFromWishlists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wish_lists', function($table){
            if(Schema::hasColumn('wish_lists','destination_id')){

                $table->dropForeign('wish_lists_destination_id_foreign');
                $table->dropColumn('destination_id');
            }
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

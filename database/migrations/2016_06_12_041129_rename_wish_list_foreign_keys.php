<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameWishListForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wish_lists', function($table){
            $table->dropForeign('whish_lists_destination_id_foreign');
            $table->foreign('destination_id')->references('id')->on('destinations');

            $table->dropForeign('whish_lists_owner_id_foreign');
            $table->foreign('owner_id')->references('id')->on('users');
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

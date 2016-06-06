<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ResetForeignKeyCategryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_destination',function($table){
            $table->dropForeign('category_experience_category_id_foreign');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->dropForeign('category_experience_experience_id_foreign');
            $table->renameColumn('experience_id','destination_id');

            $table->foreign('destination_id')->references('id')->on('destinations');
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

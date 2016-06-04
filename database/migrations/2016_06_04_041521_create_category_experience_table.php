<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_experience', function($table){
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->bigInteger('experience_id')->unsigned();
            $table->foreign('experience_id')->references('id')->on('experiences');
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

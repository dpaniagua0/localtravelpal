<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtraFieldsTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function($table) {
            // User video support
            $table->string('video_url');
            $table->string('alien_video_id');
            $table->string('video_source');

            // Profile img support
            $table->string('img_path');
            $table->string('img_type');

            // User bio
            $table->text('bio');


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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function($table){
            $table->bigIncrements('id');

            $table->text('message');
            $table->unsignedInteger('sender_id')->index();
            $table->foreign('sender_id')->references('id')->on('users');

            $table->unsignedInteger('receiver_id')->index();
            $table->foreign('receiver_id')->references('id')->on('users');

            $table->integer('status')->default(0);

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

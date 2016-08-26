<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnsReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function($table){
            $table->renameColumn('start', 'start_time');
            $table->renameColumn('end', 'end_time');

            $table->renameColumn('start_datetime', 'start');
            $table->renameColumn('end_datetime', 'end');
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

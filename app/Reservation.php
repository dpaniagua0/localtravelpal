<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name', 'last_name', 'email', 'people_qty','phone',
      'date','start_time', 'end_time', 'message', 'confirmation_number',
      'status', 'destination_id'
    ];
}

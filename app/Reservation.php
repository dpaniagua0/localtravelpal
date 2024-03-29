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
      'date','start', 'end', 'message', 'confirmation_number',
      'status', 'destination_id', 'start_time', 'end_time', 'css_class',
      'provider_id', 'is_private'
    ];

    public function destination(){
      return $this->hasOne('App\Destination', 'id','destination_id');
    }

    public function scopebyUser($query, $string) {
      return $query->where('email', '=', "{$string}");
    }

}

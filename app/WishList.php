<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
    * The destinations that belong to the list.
    */
    public function destinations(){
      return $this->belongsToMany('App\Destination', 'wish_lists_destination', 'wish_list_id', 'destination_id');
    }
    
}

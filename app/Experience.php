<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'title','description','price','min_capacity',
       'owner_id','location','max_capacity','category_id'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
    * The experiences that belong to the category.
    */
    public function destinations()
    {
        return $this->belongsToMany('App\Destination');
    }
}

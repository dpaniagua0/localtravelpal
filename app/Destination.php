<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
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

    /**
    * Get a list of categories ids
    * @return array
    */

    public function getCategoriesListAttribute(){
        return $this->categories->lists('id')->toArray();
    }

    /**
    * Scope a query to match the search
    * @return \Illuminate\Database\Eloquent\Builder
    */

    public function scopebyLocation($query, $string){
        return $query->where('location', 'like', "%{$string}%");
    }


    /**
     * The categories that belong to the experience.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_destination','destination_id','category_id');
    }

}
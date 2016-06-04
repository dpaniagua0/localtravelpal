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

    /**
    * Get a list of categories ids
    * @return array
    */

    public function getCategoriesListAttribute(){
        return $this->categories->lists('id')->toArray();
    }


    /**
     * The categories that belong to the experience.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_experience','experience_id','category_id');
    }

}

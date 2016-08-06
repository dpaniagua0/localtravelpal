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
       'owner_id','location','max_capacity','category_id',
       'price', 'price_rate', 'duration', 'duration_type',
       'video_url'
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

    public function scopePublished($query) {
      return $query->where('status', '=', '1');
    }

    public function wishlists(){
        return $this->belongsToMany('App\WishList', 'wish_lists_destination','destination_id', 'wish_list_id');
    }

    /**
    * Return all the destination reviews
    */ 
    public function reviews(){
       return $this->morphMany('App\Review', 'reviewable');
    }


    /**
     * The categories that belong to the experience.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_destination','destination_id','category_id');
    }

    public function hasCover(){
        return $this->images()->where('is_cover', '=', '1')->first();
    }
    
    /**
    * Return all the destination images
    */
    public function images(){
        return $this->hasMany('App\Image');
    }

    /**
    * Search by category
    * @param array $categories
    */
    public function scopeByCategory($query, $categories){
        return $query->whereHas('categories', function ($q) use ($categories) {
              $q->whereIn('id', $categories);
        });
    }


    public function scopeSortedBy($query, $option) {
      switch ($option) {
        case 1:
          # code...
          break;
        case 2:
          break;

        case 3:
          return $query->orderBy('price', 'ASC');
          break;
        case 4: 
          return $query->orderBy('price', 'DESC');
          break;
        case 5:
          return $query->orderBy('created_at', 'DESC');
          break;

        case 6: 
          return $query->orderBy('created_at', 'ASC');
          break;

        default:
          # code...
          break;
      }
    }
}

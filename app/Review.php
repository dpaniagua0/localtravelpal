<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'comment',
       'user_id',
       'reviewable_id',
       'reviewable_type'
    ];


    public function reviewable()
    {
        return $this->morphTo();
    }

    public function owner() {
      return $this->belongsTo('App\User', 'user_id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
    	'img_file', 'img_path',
    	'status', 'destination_id',
        'is_cover'
    ];

     /**
     * Get the destination that owns the image.
     */
    public function destination()
    {
        return $this->belongsTo('App\Destination');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image as Images;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{

	public $width;
	public $height;
	public $file;

    /**
    * 
    */
    public function resize(Request $request) {

    	$img = Image::cache(function($image) use ($request) {
    		$file = $request->file;
	    	$width = $request->width;
	    	$height = $request->height;

	    	$image->make(storage_path("app/public/upload/images/{$file}"))->resize($width, $height);
	    }, 43200, true);
	    return $img->response('jpg');
    }
}

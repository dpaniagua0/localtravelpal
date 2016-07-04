<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image as Images;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{

	private $width;
	private $height;
	private $file;

    /**
    *  Resize and return the image requested
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


    /**
    * 
    */
    public function create(){
    	return view('images.create');
    }

    public function upload($images){

    }


}

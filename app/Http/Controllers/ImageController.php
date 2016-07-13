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

   
   public function store(Request $request){
        if($request->hasFile('images')){
            $photos = $request->file('images');
            $uploaded_images = array();
            foreach ($photos as $photo) {
                $image_name = $photo->getClientOriginalName();
                $tmp_image = Image::make($photo->getRealPath())->resize(1280,500);
                $tmp_image->save(storage_path("app/public/upload/images/{$image_name}.jpg"));
                array_push($uploaded_images, array('file' => "{$image_name}.jpg", 'path' => 'resources')); 
            }
            return "true";
        }
   }

    public function show(){

    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use Storage;
use App\Category;
use App\Destination;
use Intervention\Image\ImageManagerStatic as Image;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directory = "public/pages/home/img";
        $destinations = Destination::take('9')->get();
        $temp_files = Storage::disk('local')->files($directory);
        $files = array();
        foreach ($temp_files as $file) {
          //  if(strpos($file, 'public')){
                $file = str_replace("public", "storage", $file);
                array_push($files, $file);
            //}
        }
        return view('home', compact('files', 'destinations'));
    }

    /**
    *  Upload images to home page carousel
    *
    */
    public function uploadImages(ImageRequest $request){

        
        if($request->hasFile('images')){
            $images = $request->file('images');
                
            foreach ($images as $image) {
                $image_name = md5($image->getClientOriginalName());
                $tmp_image = Image::make($image->getRealPath())->resize(1280,500);
                $tmp_image->save(storage_path("app/public/pages/home/img/{$image_name}.jpg"));
            }

            return redirect('/');
        }

    }

    public function deleteImage(Request $request) {
      $path = $request->path;
      
      if(Storage::delete($path)) {
        return redirect('/');
        //echo $path;
        //exit;
      } else {
        echo "false";
      }
    }
}

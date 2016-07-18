<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\DestinationRequest;
use App\Destination;
use App\Category;
use Auth;
use App\Image as Images;
use Intervention\Image\ImageManagerStatic as Image;

class DestinationController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['search', 'show', 'details','searchByCategory']
        ]);

        $this->middleware('admin', [
            'except' => ['search', 'show','create','details', 'edit', 'store', 'searchByCategory']
        ]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::paginate('15');
        return view('destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name','id');
        return view('destinations.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationRequest $request)
    {
        $destination = new Destination($request->all());

        $video = $this->getVideoInfo($request->video_url);
        $destination->video_source = $video["source"];
        $destination->alien_video_id = $video["alien_id"];

        if($destination->save() && $destination->categories()->sync($request->category_list)){
            if(Auth::user()->hasRole('super_admin') || Auth::user()->hasRole('admin')){
                return redirect('destinations');
            } else {
                return redirect()->route('destinations.edit', $destination->id);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $destination = Destination::findOrfail($id);
        $images = $destination->images()->paginate(6);

        return view('destinations.show', compact('destination', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::findOrfail($id);
        $images = $destination->images()->where('is_cover', 0)->paginate(6);

        $categories = Category::lists('name','id');
        return view('destinations.edit', compact('destination', 'categories', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DestinationRequest $request, $id)
    {
        $destination = Destination::findOrfail($id);
        $video = $this->getVideoInfo($request->video_url);
        $destination->video_source = $video["source"];
        $destination->alien_video_id = $video["alien_id"];

        $uploaded_images = $this->uploadPhotos($request);
        if(count($uploaded_images) > 0){
            foreach ($uploaded_images as $image) {
                $tmp_image = new \App\Image();
                $tmp_image->img_path = $image["path"];
                $tmp_image->img_file = $image["file"];
                $tmp_image->destination_id = $destination->id;
                $destination->images()->save($tmp_image);
            }
        }   

        if($destination->update($request->all()) && $destination->categories()->sync($request->category_list)){
            return redirect()->route('destinations.edit', $id);
        }
    }

    /**
    * Upload destination photos
    *
    */
    public function uploadPhotos(Request $request){

        if($request->hasFile('photos')){
            $photos = $request->file('photos');
            $uploaded_images = array();
            foreach ($photos as $photo) {
                $image_name = md5($photo->getClientOriginalName()."".date("YmdHis"));
                $tmp_image = Image::make($photo->getRealPath())->resize(1280,500);
                $tmp_image->save(storage_path("app/public/upload/images/{$image_name}.jpg"));
                array_push($uploaded_images, array('file' => "{$image_name}.jpg", 'path' => 'upload/images')); 
            }
            return $uploaded_images;
        }
    }

    public function search(Request $request) {

        $categories = Category::all();
        $query = (isset($request))? $request : "";
        if(!$request->search){
            $destinations = Destination::all();
        } else {
            $destinations = Destination::byLocation($request->search)->get();
        }
        return view('destinations.search', compact('destinations', 'query', 'categories'));
    }

    /**
    * Show details about create an experience
    */
    public function details(){
        return view('destinations.details');
    }

     /**
    * get video  info
    * @param string url $url [youtube or vimeo]
    * @return array
    */
    public function getVideoInfo($url){
        if(isset($url) && $url != ""){
            $video = parse_url($url);
            if(strpos($url,"youtube") !== false){
                $video_source = "youtube";
            } else if(strpos($url, "vimeo") !== false){
                $video_source = "vimeo";
            }
            if($video_source == "youtube") {
                $video_url = parse_str($video['query'], $url_parameters);
                $alien_video_id = $url_parameters['v'];
            } else if($video_source == "vimeo") {
                $video_url = preg_replace("@[/\\\]@", "", $video['path']);
                $alien_video_id = $video_url;
            } 
            return array(
                'source' => $video_source,
                'alien_id' => $alien_video_id
            );
        }
    }

    /**
    * Set destination cover image
    * @param \Illuminate\Http\Request  $request
    */
    public function setCover(Request $request){
        //check if destination has a cover
        $destination = Destination::findOrfail($request->destination_id);
        if($destination->hasCover()){
            //Find the image with cover set as 1
            $image = Images::findOrfail($destination->hasCover()->id);
            $image->is_cover = 0;
            $image->save();
            $destination->update(['has_cover' => 1]);
        }
        //Set the new cover
        $new_cover = Images::findOrfail($request->image_id);
        $new_cover->is_cover = 1;
        if($new_cover->save()){

            $images = $destination->images()->where('is_cover', 0)->paginate(6);
            return view('destinations.destinationImages', compact('destination', 'images'));
        } 
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destination = Destination::findOrfail($id);
        if($destination){
            $destination->categories()->detach();
            $destination->wishlists()->detach();
            if($destination->delete()){
                return redirect('destinations');
            }
        }
    }

    public function searchByCategory(Request $request){
        $categories = $request->categories;
        if($categories != -1){
            $destinations = Destination::byCategory($categories);
        } else {
            $destinations = Destination::all();
        }
        return view('helpers.destinations_preview', compact('destinations'));
    }
}

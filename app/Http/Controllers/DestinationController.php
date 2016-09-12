<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\DestinationRequest;
use App\Destination;
use App\Reservation;
use App\Category;
use App\Review;
use Auth;
use App\Image as Images;
use Intervention\Image\ImageManagerStatic as Image;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use willvincent\Rateable\Rating as Rating;



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
            'except' => ['search', 'show', 'details','searchByCategory','getGeoCode','embed']
        ]);

        $this->middleware('admin', [
            'except' => [
                'search', 'show','create','details', 
                'edit', 'store', 'searchByCategory',
                'storeReview','getGeoCode','embed'
            ]
        ]);

        /*$this->middleware('recruiter', 

        ]);*/
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

     /*   $video = $this->getVideoInfo($request->video_url);
        $destination->video_source = $video["source"];
        $destination->alien_video_id = $video["alien_id"];*/

        if($destination->save() && $destination->categories()->sync($request->category_list)){
            if(Auth::user()->hasRole('super_admin') || Auth::user()->hasRole('admin')){
                return redirect()->route('destinations');
            } else {
                return redirect()->route('destinations.edit', $destination->id);
            }
        }
    }

    /**
    * Store a new review
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function storeReview(Request $request){
        $destination = Destination::findOrfail($request->destination_id);
        if($destination){
            $review = new Review;
            $review->user_id = $request->user_id;
            $review->comment = $request->comment;

            $rating = new Rating;
            $rating->rating = $request->rating;
            $rating->user_id = $request->user_id;

            $destination->ratings()->save($rating);

            $destination->reviews()->save($review);
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
        $reservations = $destination->preapprovedReservations()->paginate(6);

        return view('destinations.show', compact('destination', 'images', 'reservations'));
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

      /*  $uploaded_images = $this->uploadPhotos($request);
        if(count($uploaded_images) > 0){
            foreach ($uploaded_images as $image) {
                $tmp_image = new \App\Image();
                $tmp_image->img_path = $image["path"];
                $tmp_image->img_file = $image["file"];
                $tmp_image->destination_id = $destination->id;
                $destination->images()->save($tmp_image);
            }
        }   */

        if($destination->update($request->all()) && $destination->categories()->sync($request->category_list)){
            return redirect()->route('destinations.edit', $id);
        }
    }

    /**
    * Upload destination photos
    *
    */
    public function uploadPhotos(Request $request){
      //  return $request->id;
        $destination = Destination::findOrfail($request->id);
        $destination_id = $destination->id;
        if($request->hasFile('photos')){
            $photos = $request->file('photos');
            $uploaded_images = array();
            foreach ($photos as $photo) {
                $image_name = md5($photo->getClientOriginalName()."".date("YmdHis"));
                $tmp_image = Image::make($photo->getRealPath())->resize(1280,500);
                $tmp_image->save(storage_path("app/public/upload/images/{$image_name}.jpg"));
                array_push($uploaded_images, array('file' => "{$image_name}.jpg", 'path' => 'upload/images')); 
            }
            if(count($uploaded_images) > 0){
                foreach ($uploaded_images as $image) {
                    $tmp_image = new \App\Image();
                    $tmp_image->img_path = $image["path"];
                    $tmp_image->img_file = $image["file"];
                    $tmp_image->destination_id = $destination_id;
                    $destination->images()->save($tmp_image);
                }
            }   
            /*return $uploaded_images;*/
           return "true";
        }
    }

    public function search(Request $request) {

        $categories = Category::all();
        $sort_by = [
            '1' => 'popularity',
            '2' => 'reviews',
            '3' => 'last expensive',
            '4' => 'most expensive',
            '5' => 'newset',
            '6' => 'oldest'
        ];

        $query = (isset($request))? $request : "";
        if(!$request->search){
            $destinations = Destination::published()->get();
        } else {
            $destinations = Destination::published()->get()->byLocation($request->search)->get();
        }
        return view('destinations.search', compact('destinations', 'query', 'categories', 'sort_by'));
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

    public function addVideo(Request $request){
        $destination = Destination::findOrfail($request->id);

        $video = $this->getVideoInfo($request->video_url);
        $destination->video_source = $video["source"];
        $destination->alien_video_id = $video["alien_id"];

        if($destination->save()){
            $source = $destination->video_source;
            $video_id = $destination->alien_video_id;
            return view('helpers.video_player', compact('source', 'video_id'));
        }
        return "false";
    }

    /**
    * Show reviews from destination
    * @param int $id
    */
    public function reviews($id){
        $destination = Destination::findOrfail($id);
        return view('destinations.reviews', compact('destination'));
    }

    /**
    * return all the reservations from destination
    *
    */
    public function reservations(Request $request){
        //$destination = Destination::findOrfail($request->id);
        //$reservations = $destination->reservations;
         $reservations = DB::table('reservations')
            ->select('id', 'date', 'start','end','status', 'css_class as className')
            ->where('destination_id','=', $request->id)->get();
        return $reservations;
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
        $sort_option = $request->sort;
        if($categories != -1){
            if($sort_option != -1){
               // $destinations = Destination::published()->byCategory($categories)->sortedBy($sort_option)->paginate(6);
                 if($sort_option == 2 || $sort_option == 1){
                    $collection = Destination::published()->byCategory($categories)->sortedBy($sort_option);
                    $page = 1;
                    $perPage = 6;
                    $destinations = new LengthAwarePaginator(
                    $collection->forPage($page, $perPage), 
                        $collection->count(), 
                        $perPage, 
                        $page
                    );
                 } else {
                    $destinations = Destination::published()->byCategory($categories)->sortedBy($sort_option)->paginate(6);
                 }
               

            } else {
                $destinations = Destination::published()->byCategory($categories)->paginate(6);
            }
        } else {
            if($sort_option != -1){
                if($sort_option == 2 || $sort_option == 1){

                    $collection = Destination::published()->sortedBy($sort_option);
                    $page = 1;
                    $perPage = 6;
                    $destinations = new LengthAwarePaginator(
                    $collection->forPage($page, $perPage), 
                        $collection->count(), 
                        $perPage, 
                        $page
                    );

                } else {
                    $destinations = Destination::published()->sortedBy($sort_option)->paginate(6);   
                }
                /* elseif($sort_option == 1) { 
                    $collection = Destination::published()->sortedBy($sort_option);
                    $page = 1;
                    $perPage = 6;
                    $destinations = new LengthAwarePaginator(
                    $collection->forPage($page, $perPage), 
                        $collection->count(), 
                        $perPage, 
                        $page
                    );
                }else {

                    $destinations = Destination::published()->sortedBy($sort_option)->paginate(6);   
                }*/
            } else {
                $destinations = Destination::published()->paginate(6);

            }
        }
        return view('helpers.destinations_preview', compact('destinations'));
    }

    public function getGeoCode(Request $request){
        $location = urlencode($request->location);
        $geocode_data = @file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?v=3&address=$location");
        $geocode_data = json_decode($geocode_data, true);

        if (!$this->check_status($geocode_data)) {   
            return array();
        }
        
        $geocode = array(
            'lat' => $geocode_data["results"][0]["geometry"]["location"]["lat"],
            'lng' => $geocode_data["results"][0]["geometry"]["location"]["lng"],
        );

        return $geocode;
    }

    /* 
    * Check if the json data from Google Geo is valid 
    */

    public function check_status($data) {
        if ($data["status"] == "OK"){ 
            return true;
        }
        return false;
    }

    /**
    * @param $id destination id
    * @param $status integer
    */
    public function updateStatus(Request $request) {
        $destination = Destination::findOrfail($request->id);
        $destination->status = $request->status;
        $destination->save();
        if(!$request->ajax()){
            if(Auth::user()->hasRole('super_admin') || Auth::user()->hasRole('recruiter')){
                return redirect('destinations');
            }
            return redirect()->route('users.guides', $destination->owner_id);
        } 
    }

    /**
    * @param $id destination id
    */
    public function embed($id){
        $destination = Destination::findOrfail($id);
        return view('destinations.embed', compact('destination'));
    }
}

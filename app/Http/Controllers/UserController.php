<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use App\WishList;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['profile']]);
        $this->middleware('admin',['only' => ['view', 'edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name','id');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        if($user->save() && $user->roles()->sync($request->role_list)){
            return redirect('users');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::findOrfail($id);
        $roles = Role::lists('name', 'id');
        if($user){
            return view('users.edit',compact('user', 'roles'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrfail($id);
        if($user->update($request->all()) && $user->roles()->sync($request->role_list)){
            return redirect('users');
        } else {
            return redirect()->route('users.edit', $id);
        }
    }


    /**
    * User profile
    * @param int $id
    * @return response
    */
    public function profile($id){
        $user = User::findOrfail($id);
        return view('users.profile', compact('user'));
    }

    public function profileEdit($id){
        $user = User::findOrfail($id);
        if($user) {
            return view('users.editProfile', compact('user'));
        }
    }

    public function updateProfile(UserRequest $request, $id) {
        $user = User::findOrfail($id);

       
        $video = $this->getVideoInfo($request->video_url);

        $user->video_source = $video["source"];
        $user->alien_video_id = $video["alien_id"];
        $image_upload = $this->uploadProfileImage($request, $user->id);

        $user->img_path = (!empty($image_upload['path']))? $image_upload['path'] : $user->img_path;
        $user->img_file =  (!empty($image_upload['file']))? $image_upload['file'] : $user->img_file;

        if($user->update($request->all())){
            return redirect()->route('users.profile', $id);
        } else {
            return redirect()->route('users.profile_edit', $id);
        }
    }

    /**
    * Upload the profile image to the server
    * @param $image, image file
    * @param $user_id
    * @return response
    */
    public function uploadProfileImage(UserRequest $request, $user_id){
        //Store image file
       // $file = $request->file('profile_image'); 
      
       // $file_name =  "img_profile".bcrypt($user->id);
      //  $file->move('profile_images/'.$user_id,$file_name);
        //return 
        if($request->hasFile('profile_image')){
            $image = $request->file('profile_image');
            $image_name = md5($user_id);
            $tmp_image = Image::make($image->getRealPath())->resize(250,250);
            $tmp_image->save(storage_path("app/public/upload/images/{$image_name}.jpg"));
            return array('file' => "{$image_name}.jpg", 'path' => 'upload/images');
        }

       /* if($request->hasFile('profile_image')){
            Storage::put(
                "public/avatars/{$user_id}/".md5($user_id).".jpg",
                file_get_contents($request->file('profile_image')->getRealPath())
            );
            return Storage::url("avatars/{$user_id}/".md5($user_id).".jpg");
        } else {
            if(Storage::url("avatars/{$user_id}/".md5($user_id).".jpg")){
               return Storage::url("avatars/{$user_id}/".md5($user_id).".jpg"); 
           } else {
                return "http://placehold.it/250x250";
           }
        }*/
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
    * Get all the user whish lists
    * @param int $user_id
    * @return response
    */
    public function wishlists($user_id){
        $user = User::findOrfail($user_id)->load('wishlists');
        return view('users.wish_lists', compact('user'));
    }

    /**
    * Return wish list content [ Destinations ]
    * @param int $id wish list id
    * @return response
    */
    public function wishListContent(Request $request){

        $wish_list = WishList::find($request->list_id);
        return view('users.list_content', compact('wish_list'));
    }

    /**
    * Return user guides
    * @param int $id user id
    * @return response
    */
    public function userGuides($id){
        $user = User::with('destinations')->whereId($id)->firstOrfail();
        $guides = $user->destinations()->paginate(4);
        return view('destinations.guides', compact('guides'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        if($user){
            if($user->delete()){
                return redirect('users');
            }
        }
    }
}

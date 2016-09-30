<?php


class Helpers {


 /* public static function render_video($video){
    return view('helpers.video_player', compact('video'))->render();
  }*/

  public static function user_video($user){
    return view('helpers.video_user', compact('user'))->render();
  }

  public static function render_video($source, $video_id){
    return view('helpers.video_player', compact('source', 'video_id'))->render();
  }

  public static function user_experiences($user){
    $destinations = $user->destinations;
    return view('helpers.user_experiences', compact('destinations'))->render();
  }

  public static function profile_image($user) {
    return view('helpers.profile_image', compact('user'))->render();
  }

  public static function home_slider($images){
    return view('helpers.slider', compact('images'))->render();
  }

  public static function render_destinations($destinations, $col_size = null){
    return view('helpers.destinations_preview', compact('destinations', 'col_size'))->render();
  }

  public static function user_wishlists($lists){
    $lists = $lists->load('destinations');
    return view('helpers.user_wishlists', compact('lists'))->render();
  }

  public static function destination_cover($destination){
    return view('helpers.destination_cover', compact('destination'))->render();
  }

  public static function destination_reviews($destination, $paginate = false){
    $reviews = $destination->reviews()->paginate(6);
    return view('helpers.destination_reviews', compact('reviews', 'paginate'))->render();
  }
  public static function destination_provider($owner){
    return view('helpers.desitnation_provider', compact('owner'))->render();
  }
  public static function guide_status($status){
    return view('helpers.guide_status', compact('status'))->render();
  }

  public static function reservation_status($status) {
    return view('helpers.reservation_status', compact('status'))->render();
  }

  public static function tour_time($destination) {
    return view('helpers.tour_time', compact('destination'));
  }
}
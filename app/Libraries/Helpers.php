<?php


class Helpers {


  public static function render_video($video){
    return view('helpers.video_player', compact('video'))->render();
  }

  public static function user_video($user){
    return view('helpers.video_user', compact('user'))->render();
  }

  public static function user_experiences($user){
    $experiences = $user->experiences;
    return view('helpers.user_experiences', compact('experiences'))->render();
  }

  public static function profile_image($user) {
    return view('helpers.profile_image', compact('user'))->render();
  }
}
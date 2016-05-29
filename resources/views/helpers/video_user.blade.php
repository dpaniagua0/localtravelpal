
@if($user->video_source == "youtube")
  <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $user->alien_video_id }}" frameborder="0" allowfullscreen></iframe>
@elseif($user->video_source == "vimeo")
  <iframe width="100%" height="315" src="//player.vimeo.com/video/{{ $user->alien_video_id }}?" frameborder="0" allowfullscreen></iframe>
@endif

@if($source == "youtube")
  <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $video_id }}" frameborder="0" allowfullscreen></iframe>
@elseif($source == "vimeo")
  <iframe width="100%" height="315" src="//player.vimeo.com/video/{{ $video_id }}?" frameborder="0" allowfullscreen></iframe>
@endif
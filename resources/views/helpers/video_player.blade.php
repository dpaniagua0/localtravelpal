<h1>{{ $video->url }}</h1>

@if($video->source == "youtube")
  <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{ $video->alien_video_id }}" frameborder="0" allowfullscreen></iframe>
  <h1>Youtube</h1>
@elseif($video->source == "vimeo")
  <h1>Vimeo</h1>
@endif
@extends('layouts.app')

@section('page-title','Home')

@section('content')
<style>

.slider-container {
    width: 100%;
    margin: 0 auto;
    display: block;
}


</style>
<div class="slider-container">
  {!! Helpers::home_slider($files)  !!}
</div>

<div class="section home-section"> 
	<div class="section-inner">
		@if(count($destinations) > 0)
			<div class="destinations-container clearfix">
			@foreach($destinations as $destination)
				<div class="destination">
					<a class="link-to-destination">
						{{--*/$cover = $destination->hasCover();/*--}}
						@if(isset($cover))
							{{--*/$cover_path = "$cover->img_path";/*--}}
							{{--*/$cover_file = "$cover->img_file";/*--}}
							{{--*/$cover_image = "/$cover_path/300x300/$cover_file";/*--}}
						@else 
							{{--*/ $cover_image = "http://placehold.it/300x300"; /*--}}
						@endif
						<img style="width: 100%" src="{{ $cover_image}}" alt="{{$destination->title}}">
						<h3>{{ $destination->title}}</h3>
					</a>
					<div class="short-description">
						<p>
							{{ str_limit($destination->description, 220) }}
						</p>

						<a class="see-more mb-5" href="{{ route('destinations.show', $destination->id)}}">See more</a>
						<div class="clearfix"></div>
					</div>
				</div>
			
			@endforeach
			</div>
		@endif
	</div>
</div>
@endsection

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

<div class="section">
	<div class="section-inner">
		@if(count($destinations) > 0)
			<div class="destinations-container clearfix">
			@foreach($destinations as $destination)
				<div class="destination">
					<a class="link-to-destination">
						<img style="width: 100%" src="http://placehold.it/300x300" alt="http://placehold.it/350x150">
						<h3>{{ $destination->title}}</h3>
					</a>
					<p>
						{{ $destination->description}}
					</p>
				</div>
			
			@endforeach
			</div>
		@endif
	</div>
</div>
@endsection

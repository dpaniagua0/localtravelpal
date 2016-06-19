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
		@if(count($categories) > 0)
			<div class="categories-container clearfix">
			@foreach($categories as $category)
				<div class="category">
					<a>
						<img style="width: 100%" src="http://placehold.it/300x300" alt="http://placehold.it/350x150">
						<h3>{{ $category->name}}</h3>
					</a>
				</div>
			
			@endforeach
			</div>
		@endif
	</div>
</div>
@endsection

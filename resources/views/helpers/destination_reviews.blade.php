@if($reviews && sizeof($reviews) > 0)

<div class="section reviews-section mb-15">
  <div class="section-inner">

<h1 class="reviews-header"><span>Reviews</span></h1>
	{{--*/ $destination_id =  $reviews[0]->reviewable->id; /*--}}
		@foreach ($reviews as $review) 

			{{--*/ $user = $review->owner /*--}}
			@if(isset($user->img_path) && $user->img_path != "")
			  {{--*/ $image_source = asset($user->img_path.'/135x135/'.$user->img_file) /*--}}
			@else
			  {{--*/ $image_source = "http://placehold.it/135x135" /*--}}
			@endif
			         
			@if(!empty($user->avatar))
				{{--*/ $image_source = $user->avatar;/*--}}
			@endif 
			<div class="row review-container">
				<div class="col-md-2">
					<img src="{{ $image_source }}"/>
				</div>
				<div class="col-md-10 text-justify">
					<h3>{{ $user->name}}</h3>
					{{ $review->comment }}
				</div>
			</div>
	    @endforeach
	    @if(!$paginate)
	    <div class="row pt-15 text-center">
	    	@if(Auth::check())
		    	<a data-toggle="modal" data-target="#add-review" class="btn btn-default inline-block">
		    		Review Destination
		    	</a>
		    @endif
		    <a  href="{{ route('destination.reviews', $destination_id)}}" class="btn btn-default inline-block">
		    	Show More
		    </a>
	    </div>
	    @else
	    <div class="text-center">
	   		{{ $reviews->links() }}
	   	</div>
	    @endif
    </div>
</div>
@endif
@if(count($destinations) > 0)
<div class="featured-guides">
    <div class="row">
        <div class="col-md-12">
        @if(empty($col_size))
            {{--*/ $col_size = "col-sm-6 col-md-6"; /*--}}
        @endif
        @foreach($destinations as $destination)
            <div class="destination-preview {{ $col_size }}">
                <a href="{{ route('destinations.show', $destination->id) }}">
                <div class="thumbnail" style="position: relative">

                    {{--*/$cover = $destination->hasCover();/*--}}
                    @if(isset($cover))
                        {{--*/$cover_path = "$cover->img_path";/*--}}
                        {{--*/$cover_file = "$cover->img_file";/*--}}
                        {{--*/$cover_image = "/$cover_path/350x350/$cover_file";/*--}}
                    @else 
                        {{--*/ $cover_image = "http://placehold.it/350x350"; /*--}}
                    @endif
                    <img src="{{$cover_image}}" alt="{{$destination->title}}">
                    <a class="btn btn-primary book-btn">Book now</a>
                    <div class="caption">
                        <h3 class="mt-5 mb-5">{{ $destination->title }}</h3>
                        <span class="rating">
                            @if(sizeof($destination->ratings) > 0)
                                {{--*/ $rating = $destination->averageRating(5); /*--}}
                                @for($i = 1; $i <= round($rating) ; $i++)
                                    <span class="star"></span>
                                @endfor
                                @if(is_float($rating))
                                    <span class="half-star"></span>
                                @endif
                            @else 
                                <span class="label label-info">No stars yet.</span>
                            @endif  
                            <span class="total-reviews">
                                @if(sizeof($destination->reviews) > 1)
                                    {{ sizeof($destination->reviews) }}  
                                    reviews    
                                @elseif(sizeof($destination->reviews) == 1)
                                    1 review
                                @else
                                    No reviews yet.
                                @endif
                            </span>
                        </span>
                        <div class="destination-shortdesc">
                            {{ $destination->description }}
                        </div>
                        <div class="thumb-footer">
                            <div class="col-md-6 text-left">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </div>
                            <div class="col-md-6 text-right">
                                <span>{{ $destination->price}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        @endforeach
        </div>
    </div>
</div>
@else 
<h1 class="alert alert-info text-center">We can't find destinations now.</h1>
@endif

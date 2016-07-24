@if(count($destinations) > 0)
<div class="featured-guides">
    <div class="row">

        @foreach($destinations as $destination)
            <div class="destination-preview col-sm-6 col-md-6">
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
                    <div class="caption">
                        <h3 class="mt-5 mb-5">{{ $destination->title }}</h3>
                        <span class="rating">
                            <span class="star"></span>
                            <span class="star"></span>
                            <span class="star"></span>
                            <span class="star"></span>
                            <span class="half-star"></span>
                            <span class="total-reviews">10 reviews</span>
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
            </div>
        @endforeach
    </div>
</div>
@else 
<h1 class="alert alert-info text-center">We can't find destinations now.</h1>
@endif

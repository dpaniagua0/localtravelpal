@if(count($destinations) > 0)
<div class="featured-guides">
    <div class="row">

        @foreach($destinations as $destination)
            <div class="destination-preview col-sm-6 col-md-6">
                <div class="thumbnail">

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
                        <h5>{{ $destination->title }}</h5>

                        <a href="{{ route('destinations.show', $destination->id) }}" class="btn btn-primary btn-lg btn-block" role="button">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@else 
<h1 class="alert alert-info text-center">We can't find destinations now.</h1>
@endif

@if(count($destinations) > 0)
<div class="featured-guides">
    <div class="row">

        @foreach($destinations as $destinations)
            <div class="col-sm-3 col-md-3">
                <div class="thumbnail">
                    <img src="http://placehold.it/242x200" alt="...">
                    <div class="caption">
                        <h5>{{ $destinations->title }}</h5>

                        <a href="{{ route('destinations.show', $destinations->id) }}" class="btn btn-primary btn-lg btn-block" role="button">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

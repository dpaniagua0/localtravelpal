@if(count($destinations) > 0)
<legend>Featured guides</legend>
<div class="featured-guides">
    <div class="row">

        @foreach($destinations as $destinations)
            <div class="col-sm-4 col-md-4">
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
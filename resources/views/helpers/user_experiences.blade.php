@if(count($experiences) > 0)
<legend>Featured guides</legend>
<div class="featured-guides">
    <div class="row">

        @foreach($experiences as $experience)
            <div class="col-sm-4 col-md-4">
                <div class="thumbnail">
                    <img src="http://placehold.it/242x200" alt="...">
                    <div class="caption">
                        <h5>{{ $experience->title }}</h5>

                        <a href="{{ route('experiences.show', $experience->id) }}" class="btn btn-primary btn-lg btn-block" role="button">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif
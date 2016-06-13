@if(count($lists) > 0)
<div class="featured-guides">
    <div class="row">

        @foreach($lists as $item)

            @section('page-title',$item->name)
            @section('meta-tags')
                <meta property="og:url"           content="http://www.localtravelpal.com/users/1/wishlists/{{$item->id}}" />
                <meta property="og:type"          content="website" />
                <meta property="og:title"         content="Your Website Title" />
                <meta property="og:description"   content="Your description" />
                <meta property="og:image"         content="http://www.localtravelpal.com/users/1/wishlists/{{$item->id}}" />
            @endsection
            <div class="col-sm- col-md-3">
                <div class="thumbnail">
                    <img src="http://placehold.it/242x200" alt="...">
                    <div class="caption">
                        <h5 class="pull-left">{{ $item->name }}</h5>

                        <div class="pull-right fb-share-button" 
                          data-href="http://www.localtravelpal.com/users/1/wishlists/{{$item->id}}" 
                          data-mobile_iframe="true"
                          data-layout="button"
                          data-title="Testing">
                        </div>
                        <div class="clearfix"></div>
                        <a href="{{ route('users.listcontent', [ 'user_id' => 1, 'list_id' => $item->id]) }}" class="btn btn-primary btn-lg btn-block" role="button">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@else 
    <h1 class="alert alert-info text-center">You don't have wishlists yet.</h1>
@endif
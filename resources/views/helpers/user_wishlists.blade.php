@if(count($lists) > 0)
<div class="featured-guides">
    <div class="row">

        @foreach($lists as $list)

            @section('meta-tags')
                <meta property="og:url"           content="http://www.locopal.com/users/1/wishlists/{{$list->id}}" />
                <meta property="og:type"          content="website" />
                <meta property="og:title"         content="Locopal" />
                <meta property="og:description"   content="Share wishlist" />
                <meta property="og:image"         content="http://www.locopal.com/users/1/wishlists/{{$list->id}}" />
            @endsection
            <div class="col-sm- col-md-3">
                @if($list->destinations()->where('has_cover', '=' ,'1')->first())
                    {{--*/$cover_file = $list->destinations()->where('has_cover', '=' ,'1')->first()->hasCover()->img_file; /*--}} 
                    {{--*/$cover_path = $list->destinations()->where('has_cover', '=' ,'1')->first()->hasCover()->img_path; /*--}}
                    {{--*/$cover_image = "/{$cover_path}/240x200/{$cover_file}";/*--}}
                @else 
                    {{--*/$cover_image = "http://placehold.it/240x200"; /*--}}
                @endif
                <div class="thumbnail">
                    <img src="{{$cover_image}}" alt="cover">
                    <div class="caption">
                        <h5 class="pull-left">{{ $list->name }}</h5>

                        <div class="pull-right fb-share-button" 
                          data-href="http://www.locopal.com/users/1/wishlists/{{$list->id}}" 
                          data-mobile_iframe="true"
                          data-layout="button"
                          data-title="Testing">
                        </div>
                        <div class="clearfix"></div>
                        <a href="{{ route('users.listcontent', [ 'user_id' => 1, 'list_id' => $list->id]) }}" class="btn btn-primary btn-lg btn-block" role="button">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@else 
    <h1 class="alert alert-info text-center">You don't have wishlists yet.</h1>
@endif
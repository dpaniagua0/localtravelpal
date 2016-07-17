@extends('layouts.app')
@section('page-title','Destination')
@section('content')

@if($destination->hasCover())
  {{--*/$cover_file = $destination->hasCover()->img_file; /*--}} 
  {{--*/$cover_path = $destination->hasCover()->img_path; /*--}}
@endif

@if(isset($cover_file) && isset($cover_path))
  {{--*/$cover_image = "/{$cover_path}/1200x350/{$cover_file}";/*--}}
@else
  {{--*/$cover_image = "http://placehold.it/1200x350"; /*--}}
@endif
<style>
  .destination-bg {
    background: url('{{$cover_image}}') no-repeat;
    background-position: center center;
    background-size: cover; 
  }
</style>
@section('facebook_sdk')
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '150683558679229',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
@endsection

<div class="section-top destination-bg">
  <div class="has-pull-top"></div>
</div>
<div class="section pull-top">
  <div class="destination-details">
    <div class="destination-title">
      <h1>{{ $destination->title }} <small>with</small> {{$destination->owner->name}}</h1>
      <h3>{{ $destination->location }}</h3>
      @if(count($destination->categories) > 0)
        @foreach($destination->categories as $category)
          <a href="#">#{{$category->name}}</a>
        @endforeach
      @endif
    </div>
    
    <div class="destination-actions">
        <a class="btn btn-danger contact-btn">Contact {{ $destination->owner->name}}</a>
        <!-- Split button -->
        @if(Auth::check())
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Add to Wishlist</button>
          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu">
            <li>
              <a href="#" data-toggle="modal" data-target="#add-list">
                <i class="fa fa-plus"></i>
                Add new wishlist
              </a>
            </li>
            {{--*/$user_wishlists = (Auth::check()) ? Auth::user()->wishlists : false; /*--}}
            @if(count($user_wishlists) > 0) 
              @foreach($user_wishlists as $list)
              <li>
                <a id="{{$list->id}}"  class="wish-list add-to-list" href="#">
                  {{ $list->name}}
                </a>
              </li>
              @endforeach
            @endif
          </ul>
        </div>
        @endif
    </div>

    <div class="destination-description">
      <p>
        {{ $destination->description}}
      </p>
      <div class="social-shares">
        <!-- Facebook share button code -->
        <div class="fb-share-button" 
          data-href="http://www.locopal.com/destinations/{{$destination->id}}" 
          data-layout="button_count">
        </div>
      </div>
    </div>
  </div>


{{--*/$user_img_file = $destination->owner->img_file; /*--}} 
{{--*/$user_img_path = $destination->owner->img_path; /*--}}

@if(!empty($user_img_path) && !empty($user_img_file))
  {{--*/$user_profile_img = "/{$user_img_path}/150x150/{$user_img_file}"; /*--}}
@else
  {{--*/$user_profile_img = "http://placehold.it/150x150"; /*--}}
@endif

@if(!empty($user->avatar))
  {{--*/ $user_profile_img = $destination->owner->avatar;/*--}}
@endif 
  <div class="destination-banner">
    <a href="{{ route('users.profile', $destination->owner->id)}}">
    <img class="thumbnail" src="{{$user_profile_img}}">
    </a>
  </div>
</div>

<div class="clearfix"></div>
@if(Auth::check())
  @include("destinations.add_list_modal")
@endif
@endsection



@section('app-js')
<script type="text/javascript">
 $(function(){


  $("form#wishlist-form").formValidation();

  $("form#wishlist-form").ajaxForm({
    target: ".modal-body",

  });

 }); 
</script>
@endsection



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
                <a id="{{$list->id}}" data-destination="{{ $destination->id }}" class="wish-list add-to-list" href="#">
                  {{ $list->name}}
                </a>
              </li>
              @endforeach
            @endif
          </ul>
        </div>
        @endif
    </div>

    <ul class="destination-tabs list-inline">
      <li role="presentation" class="active"><a href="#details" aria-controls="home" role="tab" data-toggle="tab">Details</a></li>
      <li role="presentation"><a href="#reservations" aria-controls="home" role="tab" data-toggle="tab">Reservations</a></li>
    </ul>

    <div  class="tab-content">
      <div id="details" class="destination-description tab-pane active" role="tabpanel">
        <p>
          {{ $destination->description}}
        </p>
        
      </div>
      <div id="reservations" class="tab-pane" role="tabpanel">
      [[ FORM HERE ]]
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

    <div class="social-shares">
      <!-- Facebook share button code -->
      <div class="fb-share-button" 
        data-href="http://www.locopal.com/destinations/{{$destination->id}}" 
        data-layout="button_count">
      </div>
    </div>
   
  </div>
  <div class="clearfix"></div>
  
</div>
<div class="gallery-section">

  @foreach($images as $image)
  <div class="gallery-item">
    <a href="#"> 
      <img src="/{{$image->img_path}}/250x250/{{$image->img_file}}" alt="...">
    </a>
     <div class="img-overlay"></div>
  </div>
  @endforeach
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

  var addListBtn = $(".add-to-list");
  $(addListBtn).on("click", function(){
    var listId = $(this).attr("id");
    var listDestination = $(this).attr("data-destination");
    addToList(listId, listDestination).done(function(response){
      if(response == "true"){
        eModal.alert("Destination added.");
      }
    });
  });

  function addToList(listId, destinationId){
    var data = {};
    var token = "{{ csrf_token()}}";
    data["list_id"] = listId;
    data["destination_id"] = destinationId;
    data["_token"] = token;
    return $.ajax({
      url: "/addToList",
      type: "post",
      data: data
    });
  }


 }); 
</script>
@endsection



@extends('layouts.app')
@section('page-title',"$destination->title")
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
 <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
<div class="section-top destination-bg">
  <div class="has-pull-top"></div>
</div>
<div class="section section-destination pull-top pb-15">
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
        <a class="btn btn-danger contact-btn" data-target="#send-message" data-toggle="modal">
          Contact {{ $destination->owner->name}}
        </a>
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
        <div class="row">
          <div class="col-md-4 col-xs-12">
            <h4 class="text-center">Request a reservation</h4>
            {!! Form::open([
                 'route' => 'reservations.checkout',
                 'method' => 'POST',
                 'class' => 'form-horizontal'
            ])  !!}
            <div class="form-group">
              <label>Date</label>
              <br>
              {!! Form::text('date', null,[ 'class' => 'form-control date-input'])  !!}
            </div>
            <div class="form-group">
              <label>Time</label>
              <br>
              {!! Form::text('start_time', null, [ 'class' => 'form-control time-input']) !!}
            </div>
            <div class="form-group">
              <label>Guest</label>
              <br>
              {!! Form::text('people_qty', null, [ 'class' => 'form-control'])  !!}
            </div>
            
            <button class="btn btn-info mt-25">Request Reservation</button>
          </div>

            {!! Form::close() !!}
          </div>


        @if(sizeof($reservations))
          <h3>Instant Reservations</h3>
          @foreach($reservations as $reservation)
            <div class="row pl-5 pr-5">
              <div class="col-md-12">
              {!! Form::model($reservation,[
                  'route' => 'reservations.checkout',
                  'class' => 'form-horizontal insta-form',
                  'method' => 'POST',
                  'id' => 'reservation-form'
              ]) !!}
              {!! Form::hidden('destination_id', $destination->id)  !!}
              {!! Form::hidden('reservation_id', $reservation->id)!!}
              <div class="col-md-9" 
              style="background-color: #fff; border-bottom: 1px solid #28c0da;line-height: 35px">

              <div class="col-md-5 col-xs-5 text-center">
                  {!! Form::hidden('date',null) !!}
                <p class="form-control-static">
                  {{ date("M d, Y", strtotime($reservation->date)) }}
                </p>
              </div>
              <div class="col-md-4 col-xs-4 text-center">
                <p class="form-control-static"> 
                  {{ date("h:i A", strtotime($reservation->start_time)) }}
                </p>
              </div>
              <div class="col-md-3 pt-5 pb-5 col-xs-3">
                <button class="btn btn-primary btn-sm">Book</button>
              </div>
              <div class="clearfix"></div>
              {!! Form::close() !!}
            </div>
            </div>
            </div>
              
          @endforeach
        @endif
      </div>
    </div>
  </div>



{{--*/$user_img_file = $destination->owner->img_file; /*--}} 
{{--*/$user_img_path = $destination->owner->img_path; /*--}}

@if(!empty($user_img_path) && !empty($user_img_file))
  {{--*/$user_profile_img = "/{$user_img_path}/245x250/{$user_img_file}"; /*--}}
@else
  {{--*/$user_profile_img = "http://placehold.it/245x250"; /*--}}
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
    <br>
    <a class="btn btn-info btn-block" data-toggle="modal" data-target="#add-review">Review Destination</a>
  </div>
  <div class="clearfix"></div>
  
</div>
<div class="clearfix"></div>
@if(sizeof($images) > 0)
  <div class="gallery-section">

    @foreach($images as $image)
      <div class="gallery-item" href="/{{$image->img_path}}/750x550/{{$image->img_file}}" 
        data-toggle="lightbox" data-gallery="multiimages" data-title="{{ $destination->title }}">
        <a href="#"> 
          <img src="/{{$image->img_path}}/250x250/{{$image->img_file}}" alt="...">
        </a>
         <div class="img-overlay"></div>
      </div>
    @endforeach
  </div>
@endif

{!! Helpers::destination_provider($destination->owner) !!}

{!! Helpers::destination_reviews($destination) !!}

<div id="map" style="width:100%;height:380px;"></div>




@if(Auth::check())
  @include("destinations.add_list_modal")
  @include("destinations.add_review_modal")
  @include("users.send_message")
@endif
@endsection



@section('app-js')
<script type="text/javascript">
  var lat = 0;
  var lng = 0;
  var mapLocation = "{{ $destination->location }}";
  var destinationTitle = "{{ $destination->title }}";
 $(function(){


  $("form#wishlist-form").formValidation();

  $("form#wishlist-form").ajaxForm({
    resetForm: true,
    success: function(){
      $("body").find(".modal").modal('hide');
      eModal.alert("Destination added to list.");
    }
  });

  $("form#reviews-form").formValidation();

  $("form#reviews-form").ajaxForm({
    resetForm: true,
    success: function(){
      $("body").find(".modal").modal('hide');
      eModal.alert("Destination added to list.");
    }
  });

  $("form#send-message").formValidation();
  $("form#send-message").ajaxForm({
    resetForm: true,
    success: function(){
      $("body").find(".modal").modal('hide');
      eModal.alert("Your messge has been sent.");
    }
  });

  DESTINATIONS.loadGallery();

  DESTINATIONS.getGoeCode(mapLocation).done(function(response){
    lat = response["lat"];
    lng = response["lng"];
    initMap(lat,lng);
  });

  $('#add-review, #send-message').on('hidden.bs.modal', function (e) {
    var form = $(this).find("form");
    $(form).find('textarea').val('');
  });


  var addListBtn = $(".add-to-list");
  $(addListBtn).on("click", function(){
    var listId = $(this).attr("id");
    var listDestination = $(this).attr("data-destination");
    addToList(listId, listDestination).done(function(response){
      if(response == "true"){
        eModal.alert("Destination added to list.");
      }
    });
  });


  $(".time-input").datetimepicker({
    format: 'LT'
  });
  $(".date-input").datetimepicker({
     format: 'DD/MM/YYYY'
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


  function initMap(lat,lng) { 

    var myLatLng = {lat: lat, lng: lng};

    var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: lat, lng: lng },
      zoom: 8,
      scrollwheel: false
    });
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: destinationTitle
    });
    map.setZoom(13);
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwQyNYSiMpxfOv79g1xhEN5HHESrJYprI"
    async defer></script>
@endsection



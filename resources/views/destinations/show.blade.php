@extends('layouts.app')
@section('page-title','Destination')
@section('content')
<style>
  .destination-bg {
    background: url('http://placehold.it/1200x350') no-repeat;
    background-position: center center;
    background-size: cover; 
  }
</style>
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
        <a class="btn btn-danger contact-btn">Add to wishlist</a>
    </div>
    <div class="destination-description">
      {{ $destination->description}}
    </div>
  </div>

  <div class="destination-banner">
    <img src="{{asset($destination->owner->img_path)}}" style="width: 100%">
  </div>
</div>

@endsection




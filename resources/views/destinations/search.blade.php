@extends('layouts.app')
@section('page-title','Search Destinations')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      @if(count($destinations) > 0) 
        <div class="row">
          <div class="col-md-2">

          </div>
          <div class="col-md-10">

            <hr>
            <h2>Results for: {{ $query }}</h2>
            {{ count($destinations) }}
          </div>
        </div>
      @else 
        <h1 class="alert alert-info text-center">We can't find this place right now.</h1>
      @endif
    </div>
  </div>
</div>
@endsection




@extends('layouts.app')
@section('page-title','Search Destinations')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      @if(count($destinations) > 0) 
      <div class="row">
        <div class="col-md-12">
         <div class="search-destinations pt-5 pb-5">
          {!! Form::open([
          'route' => 'destinations.search',
          'class' => 'form-inline',
          'method' => 'post'
          ]) !!}
          <div class="form-group pl-5 pr-5" style="width:100%">
            {!! Form::text('search', null, [
            'placeholder' => 'Enter your new destination to find local experiences', 'class' => 'form-control pull-left mr-5',
            'style' => 'width:86%'

            ]) !!}
            <button type="submit" class="btn btn-default pull-rigth ml-15">Search</button>
            
          </div>
          

          {!! Form::close() !!}
        </div>
        <hr>
        @if($query != "")
        <h2>Results for: {{ $query }}</h2>
        {{ count($destinations) }}
        @else 
        <h2>All results</h2>
        @endif

        <div class="row">
          {!! Helpers::render_destinations($destinations) !!}
        </div>
      </div>
    </div>
    @else 
    <h1 class="alert alert-info text-center">We can't find this place right now.</h1>
    @endif
  </div>
</div>
</div>
@endsection




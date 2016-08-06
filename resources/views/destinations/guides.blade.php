@extends('layouts.app')
@section('page-title','Destinations')
@section('content')
<div class="section clearfix pt-30">
    <div class="section-inner">

        <h1 class="pull-left">My Guides</h1>
        <a class="btn btn-default pull-right"  href="{{ route('destinations.create') }}">
            <i class="fa fa-plus"></i>  Add a Destination
        </a>
        <div class="clearfix"></div>
        <hr>
        @if(count($guides) > 0)
        @foreach($guides as $guide)

            @if($guide->hasCover())
              {{--*/$cover_file = $guide->hasCover()->img_file; /*--}} 
              {{--*/$cover_path = $guide->hasCover()->img_path; /*--}}
            @endif

            @if(isset($cover_file) && isset($cover_path))
              {{--*/$cover_image = "/{$cover_path}/350x150/{$cover_file}";/*--}}
            @else
              {{--*/$cover_image = "http://placehold.it/350x150"; /*--}}
            @endif
        <div class="guide-container row">
            <div class="col-md-5">
                <img src="{{ $cover_image }}" class="img-rounded"/>
            </div>
            <div class="col-md-7 text-left">
                <h3 class="guide-title">
                    {{ $guide->title}} 
                    {!! Helpers::guide_status($guide->status)  !!}
                </h3>
                <p class="pt-15">
                    Location: {{ $guide->location }}
                </p>
                <a href="{{ route('destinations.show', $guide->id) }}"  class="btn btn-info">
                    <i class="fa fa-eye"></i> View
                </a>
                <a href="{{ route('destinations.edit', $guide->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                <a class="btn btn-danger confirm-btn"  href="{!! route('destinations.delete', [$guide->id]) !!}"
                         data-title="Are you sure?" 
                         data-message="Deleting this guide,this will delete everything related to it" >
                         Delete
                </a>
                <a class="btn btn-success confirm-btn"  href="{!! route('destinations.updateStatus', [ 'id' => $guide->id, 'status' => 1]) !!}"
                         data-title="Are you sure?" 
                         data-message="When you puslish a destination it will be avaialable for all the users">
                        Publish
                </a>
                
            </div>
        </div>
        @endforeach 

        {!! $guides->links() !!}
        @else 
        <h1 class="alert alert-info text-center">No guides created</h1>
        @endif

    </div>
</div>
@endsection




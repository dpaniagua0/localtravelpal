@extends('layouts.app')
@section('page-title','Destinations')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
                <h1>My Guides</h1>
                <hr>
                @if(count($guides) > 0)
                    @foreach($guides as $guide)
                        <div class="guide-container">
                            <div class="col-md-3">
                                <img src="http://placehold.it/350x150"/>
                            </div>
                            <div class="col-md-9 text-left">
                                {{ $guide->title}}
                            </div>
                        </div>
                    @endforeach 

                    {!! $guides->links() !!}
               @else 
                    <h1 class="alert alert-info text-center">No guides created</h1>
                @endif
                
            </div>
        </div>
    </div>
@endsection




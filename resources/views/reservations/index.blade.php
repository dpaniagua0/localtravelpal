@extends('layouts.app')

@section('page-title', 'Messages')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Reservations
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @if(!$reservations)
                                <p class="alert alert-info">You don't have any reservation.</p>
                            @else
                                @foreach($reservations as $reservation)
                                    
                                @endforeach
                                {{ $reservations->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




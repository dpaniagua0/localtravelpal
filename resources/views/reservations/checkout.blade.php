@extends('layouts.app')
@section('page-title','Create Experience')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                     <div class="panel-heading">Checkout</div>

                    <div class="panel-body">
                      Reservation
                      {{ $reservation }}
                      
                      Destination

                      {{ $reservation->destination }}
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection


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
                            <div class="col-md-12">
                            @if(sizeof($reservations) <= 0)
                                <p class="alert alert-info text-center">You don't have any reservation.</p>
                            @else
                                <table class="table table-striped">
                                    <thead>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Destination</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Check Out</th>
                                    </thead>
                                    <tbody>
                                        @foreach($reservations as $reservation)
                                            <tr>
                                                <td>{{ $reservation->id }}</td>
                                                <td>
                                                    {!! Helpers::reservation_status($reservation->status) !!}
                                                </td>
                                                <td>{{ $reservation->destination->title }}</td>
                                                <td>{{ date("d l, F Y", strtotime($reservation->date)) }}</td>
                                                <td>{{ date("h:i A", strtotime($reservation->start)) }}</td>
                                                <td>
                                                    @if($reservation->status == 2)
                                                        {!! Form::model($reservation,[
                                                              'route' => 'reservations.checkout',
                                                              'class' => 'form-horizontal insta-form',
                                                              'method' => 'POST',
                                                          ]) !!}    
                                                            {!! Form::hidden('reservation_id', $reservation->id)!!}
                                                            <button type="submit" class="btn btn-success">Pay</button>
                                                          {!! Form::close() !!}
                                                    @elseif($reservation->status == 1)
                                                        <button class="btn btn-default disabled">Waiting for Approval</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $reservations->links() }}
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




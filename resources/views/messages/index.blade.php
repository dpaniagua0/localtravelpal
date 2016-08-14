@extends('layouts.app')

@section('page-title', 'Messages')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Messages
                    </div>
                    <div class="panel-body">
                       @include('messages.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




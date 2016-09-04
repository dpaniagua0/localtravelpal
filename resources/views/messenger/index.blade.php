@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Messages
                </div>
                <div class="panel-body">
                    @if (Session::has('error_message'))
                        <div class="alert alert-danger" role="alert">
                            {!! Session::get('error_message') !!}
                        </div>
                    @endif
                    @if($threads->count() > 0)
                        @include('messenger.table')
                    @else
                        <p>Sorry, no threads.</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@stop
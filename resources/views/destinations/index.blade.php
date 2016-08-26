@extends('layouts.app')
@section('page-title','Destinations')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Destinations
                    </div>
                    <div class="panel-body">
                        <a href="{{ route('destinations.create') }}" class="btn btn-primary" role="button">
                            Create destination
                        </a>
                        @include('destinations.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




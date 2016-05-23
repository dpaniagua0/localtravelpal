@extends('layouts.app')
@section('page-title','Users')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users
                    </div>

                    <div class="panel-body">
                        <a href="{{ route('users.create') }}" class="btn btn-primary" role="button">
                            Create user
                        </a>
                        @include('users.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




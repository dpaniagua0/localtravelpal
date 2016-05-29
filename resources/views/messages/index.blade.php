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
                        <a href="{{ route('categories.create') }}" class="btn btn-primary" role="button">
                            {{trans('common.create')}} message
                        </a>

                        <h1>Your messages goes here [ this section is on development ]</h1>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




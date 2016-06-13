@extends('layouts.app')
@section('page-title','Users')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       {{ $wish_list->name}}
                    </div>
                    <div class="panel-body">
                        {!! Helpers::render_destinations($wish_list->destinations) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




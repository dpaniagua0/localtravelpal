@extends('layouts.app')
@section('page-title','Experiences')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Experiences
                    </div>

                    <div class="panel-body">
                        <a href="{{ route('experiences.create') }}" class="btn btn-primary" role="button">
                            Create experience
                        </a>
                        @include('experiences.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




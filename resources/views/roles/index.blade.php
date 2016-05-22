@extends('layouts.app')

@section('page-title', 'Roles')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Roles
                    </div>

                    <div class="panel-body">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary" role="button">
                            {{trans('common.create')}} role
                        </a>
                        @if(count($roles) > 0)
                            @include('roles.table')
                        @else
                            <h3 class="alert alert-info text-center">{{ trans('common.no_records')}}</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




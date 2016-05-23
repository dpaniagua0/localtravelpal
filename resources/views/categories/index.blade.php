@extends('layouts.app')

@section('page-title', 'Categories')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categories
                    </div>

                    <div class="panel-body">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary" role="button">
                            {{trans('common.create')}} category
                        </a>
                        @if(count($categories) > 0)
                            @include('categories.table')
                        @else
                            <h3 class="alert alert-info text-center">{{ trans('common.no_records')}}</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




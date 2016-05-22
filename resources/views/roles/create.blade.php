@extends('layouts.app')

@section('page-title', 'Roles')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New Role</div>

                <div class="panel-body">
                  @include('common.errors')
                  {!! Form::open([
                        'route' => 'roles.store',
                        'class' => 'form-horizontal',
                        'method' => 'POST'
                      ]) !!}

                    @include('roles.fields')

                  {!! Form::close() !!}
                  
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

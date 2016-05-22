@extends('layouts.app')

@section('page-title', 'Roles')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Role</div>

                <div class="panel-body">
                  @include('common.errors')
                  {!! Form::model($role,[
                        'route' => ['roles.update', $role->id],
                        'class' => 'form-horizontal',
                        'method' => 'PATCH'
                      ]) !!}

                    @include('roles.fields')

                  {!! Form::close() !!}
                  
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

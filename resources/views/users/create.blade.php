@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New User</div>

                <div class="panel-body">
                  @include('common.errors')
                  {!! Form::open([
                        'route' => 'users.store',
                        'class' => 'form-horizontal',
                        'method' => 'POST'
                      ]) !!}

                    @include('users.fields')

                  {!! Form::close() !!}
                  
              </div>
          </div>
      </div>
  </div>
</div>
@endsection

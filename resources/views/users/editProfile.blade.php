@extends('layouts.app')

@section('page-title','Edit User')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit User</div>

                    <div class="panel-body">
                        @include('common.errors')
                        {!! Form::model($user,[
                             'route' => ['users.update_profile', $user->id],
                             'class' => 'form-horizontal',
                             'method' => 'patch'
                           ]) !!}


                        @include('users.profileFields')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

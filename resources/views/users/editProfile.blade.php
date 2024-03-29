@extends('layouts.app')

@section('page-title','Edit User')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-group">
                  <li class="list-group-item list-bg-default">
                    Personal settings
                  </li>
                  <li class="list-group-item">
                    <a>Profile</a>
                  </li>
                  <li class="list-group-item">
                    <a>Account</a>
                  </li>
                </ul>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="mt-5 mb-5">Profile</h3>
                    </div>

                    <div class="panel-body">
                        @include('common.errors')
                        {!! Form::model($user,[
                             'route' => ['users.update_profile', $user->id],
                             'class' => 'form-horizontal',
                             'method' => 'patch',
                             'files' => true
                           ]) !!}


                        @include('users.profileFields')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('app-js')
    <script type="text/javascript">
        $("select.basic-multiple").select2();
        
        $("#profile_image").change(function () {
          previewProfile(this);
        
        });
        function previewProfile(input) {
        
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              $('.preview-thumbnail').attr('src', e.target.result);
            }

          reader.readAsDataURL(input.files[0]);
        
          }
        }

    </script>
@endsection

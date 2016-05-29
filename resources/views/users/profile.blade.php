@extends('layouts.app')

@section('page-title', $user->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-4">

                        {!! Helpers::profile_image($user) !!}
                        <h2 class="profile-name">{{ $user->name }}</h2>
                        <h5>Location</h5>
                        <h5>{{ trans('common.joined_on') }} at  {{ date("M, Y", strtotime($user->created_at)) }}
                        <br>
                        @if(Auth::check() && Auth::user()->id != $user->id)
                        <a class="btn btn-success btn-lg btn-block">
                            Contact me
                        </a>
                        <a class="btn btn-primary btn-lg btn-block">
                            Review me
                        </a>
                        @endif
                    </div>
                    <div class="col-md-7">
                        @if(Auth::check()  && Auth::user()->id == $user->id)
                            <a class="btn btn-default pull-right" href="{{ route('users.profile_edit', Auth::user()->id) }}">Edit profile</a>
                            <div class="clearfix"></div>
                        @endif
                        <legend>{{ $user->name }} Interests</legend>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at arcu commodo, ornare metus sed, tincidunt erat. Suspendisse vestibulum leo nec est aliquam, nec faucibus ante imperdiet. Proin fringilla posuere hendrerit.
                            Aenean turpis urna, maximus commodo posuere in, suscipit consectetur augue. Quisque porttitor lobortis quam quis dictum.

                        </p>

                        <legend>Bio</legend>
                        <p class="user-bio">
                            <small>Bio</small>
                            {{ html_entity_decode($user->bio) }}
                        </p>
                        <br>
                        <div>
                            {!! Helpers::user_video($user) !!}
                        </div>

                        {!! Helpers::user_experiences($user) !!}
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

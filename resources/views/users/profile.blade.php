@extends('layouts.app')

@section('page-title', Auth::user()->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-4">

                        <img class="img-thumbnail" style="width: 100%" src="http://placehold.it/250x250">
                        <h2 class="profile-name">{{ $user->name }}</h2>
                        <h5>Location</h5>
                        <br>
                        <a class="btn btn-success btn-lg btn-block">
                            Contact me
                        </a>
                        <a class="btn btn-primary btn-lg btn-block">
                            Review me
                        </a>
                    </div>
                    <div class="col-md-7">
                        @if(Auth::user()->id == $user->id)
                            <a class="btn btn-default pull-right" href="{{ route('users.profile_edit', Auth::user()->id) }}">Edit profile</a>
                            <div class="clearfix"></div>
                        @endif
                        <legend>{{ $user->name }} Interests</legend>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque at arcu commodo, ornare metus sed, tincidunt erat. Suspendisse vestibulum leo nec est aliquam, nec faucibus ante imperdiet. Proin fringilla posuere hendrerit. Aenean turpis urna, maximus commodo posuere in, suscipit consectetur augue. Quisque porttitor lobortis quam quis dictum.                        <hr>
                        <p class="user-bio">
                            {{ html_entity_decode($user->bio) }}
                        </p>
                        <br>
                        <legend>Featured guides</legend>
                        <div class="featured-guides">
                            <div class="row">
                                <div class="col-sm-4 col-md-4">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/242x200" alt="...">
                                        <div class="caption">
                                            <h5>Rating here</h5>

                                            <a href="#" class="btn btn-primary btn-lg btn-block" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/242x200" alt="...">
                                        <div class="caption">
                                            <h5>Rating here</h5>

                                            <a href="#" class="btn btn-primary btn-lg btn-block" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4">
                                    <div class="thumbnail">
                                        <img src="http://placehold.it/242x200" alt="...">
                                        <div class="caption">
                                            <h5>Rating here</h5>

                                            <a href="#" class="btn btn-primary btn-lg btn-block" role="button">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

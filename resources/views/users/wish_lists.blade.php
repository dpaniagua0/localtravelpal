@extends('layouts.app')
@section('facebook_sdk')
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '150683558679229',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        My Whish lists
                    </div>
                    <div class="panel-body">
                        <!-- Uses the same helper for destinations -->
                        {{--*/ $lists = $user->wishlists; /*--}}

                        {!! Helpers::user_wishlists($lists) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





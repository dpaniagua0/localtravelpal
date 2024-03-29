<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     @yield('meta-tags')

    <title>LocoPal - @yield('page-title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.7&appId=150683558679229";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</head>
<body id="app-layout">
    @yield('facebook_sdk')

    @if(Auth::check())
        @include('layouts.navigation')
    @endif
    <div class="page-wrap">
    @yield('content')

    @if(!Auth::check())
        @include("layouts.login")
        @include("layouts.register")
    @endif
    </div>

    @if(Auth::check())
    <div class="section pre-footer pt-15 pb-15">
        <div class="section-inner">
            <h1 class="mt-15 mb-15">Guides to your Favorite Destinations</h1>
        </div>
    </div>
    <footer class="footer">
      <div class="section">
        <div class="section-inner  pt-15 pb-15 clearfix">
            <div class="footer-lside">
                <ul class="list-inline terms-list ">
                    <li>License information</li>
                    <li>Terms of use</li>
                    <li>Privacy policy</li>
                </ul>
                <h5 class="copyright">&copy;2016 LocoPal</h5>
            </div>
            <div class="footer-rside">
                <ul class="social-list list-inline">
                    <li><i class="fa fa-facebook circle-icon" aria-hidden="true"></i></li>
                    <li><i class="fa fa-google-plus circle-icon" aria-hidden="true"></i></li>
                    <li><i class="fa fa-instagram circle-icon" aria-hidden="true"></i></li>
                    <li><i class="fa fa-twitter circle-icon" aria-hidden="true"></i></li>
                    <li><i class="fa fa-pinterest circle-icon" aria-hidden="true"></i></li>
                </ul>
            </div>
        </div>
      </div>
    </footer>
    @endif
    
    <script src="{{ elixir('js/app.js') }}"></script>
    <script src="{{ elixir('js/all.js') }}"></script>
    
    @yield('app-js')
</body>
</html>

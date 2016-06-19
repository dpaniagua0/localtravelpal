<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     @yield('meta-tags')

    <title>Local Travel Pal - @yield('page-title')</title>

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
</head>
<body id="app-layout">
    @yield('facebook_sdk')

    @include('layouts.navigation')

    @yield('content')

    @yield('app-js')

   
    @yield('pre-footer')

    <footer class="footer">
      <div class="section pt-30 pb-15">
        <div class="section-inner clearfix">
            <div class="pull-left">
                <ul class="list-inline terms-list ">
                    <li>License information</li>
                    <li>Terms of use</li>
                    <li>Privacy policy</li>
                </ul>
                <h5 class="copyright">&copy;2016 LocoPal</h5>
            </div>
            <div class="pull-right">
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

    <script src="{{ elixir('js/app.js') }}"></script>

    <script src="{{ elixir('js/all.js') }}"></script>


</body>
</html>

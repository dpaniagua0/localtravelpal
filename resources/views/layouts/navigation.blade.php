<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/home') }}">
                Local Travel Pal
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
           <!-- <ul class="nav navbar-nav">
                <li><a href="{{ url('/home') }}">Home</a></li>
            </ul>-->

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if(Auth::check() && Auth::user()->hasRole('super_admin'))
                    @include('layouts.adminmenu')
                @endif
                <li><a href="#">Request a trip</a></li>
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li><a href="{{ route('experiences.create') }}">Create an experience</a></li>
               
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('messages.index') }}">
                                    <i class="fa fa-btn fa-inbox" aria-hidden="true"></i>
                                    {{ trans('common.inbox') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.profile', Auth::user()->id)}}">
                                    <i class="fa fa-btn fa-user" aria-hidden="true"></i>
                                    {{ trans('common.profile') }}
                                </a>
                            </li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                           
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
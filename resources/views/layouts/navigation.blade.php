<nav class="navbar navbar-default navbar-static-top">
    <div class="section">
        <div class="section-inner">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="brand-logo" src="{{ asset('storage/upload/images/locopal.png') }}">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
               <!-- <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>-->

                <!-- Right Side Of Navbar -->
                <!-- Show wishlist button only to logged users -->
                <div class="wish-list-nav">
                    @if(Auth::check())
                        <a class="wish-list-btn" href="{{ route('users.whishlists', Auth::user()->id  )}}">
                            Whishlist
                        </a>
                    @endif
                </div>
                <!-- -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{{ route('destinations.details') }}">List a destination</a></li>
                   
                    @if(Auth::check() && Auth::user()->hasRole('super_admin'))
                        @include('layouts.adminmenu')
                    @endif
                    @if (Auth::guest())
                        <li><a href="#" data-target="#login-modal" data-toggle="modal">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                    
                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hi! <span class="username-span">{{ Auth::user()->name }}</span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                 <li>
                                    <a href="{{ route('users.profile', Auth::user()->id)}}">
                                        {{ ucfirst(trans('common.profile')) }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('messages.index') }}">
                                        {{ ucfirst(trans('common.inbox')) }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('messages.index') }}">
                                        {{ ucfirst(trans('common.reservations')) }}
                                    </a>
                                </li>
                                @if(Auth::user()->isProvider())
                                <li class="dropdown-header">Local provider</li>
                                <li>
                                    <a href="{{ route('users.guides', Auth::user()->id)}}">
                                       {{ ucfirst(trans('common.userguides')) }}
                                    </a>
                                </li>
                                @endif
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ url('/logout') }}">Sign Out</a>
                                </li>
                               
                            </ul>
                        </li>
                    @endif
                </ul>
               
            </div>
        </div>
    </div>
</nav>
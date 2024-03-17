        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex align-items-center">
                <h1 class="logo me-auto"><a href="{{ route('index')}}"><img src="{{ asset('images/logo_images/' . $logo->logo_image) }}" alt="" class="img-fluid"> {{ $logo->logo_name }}</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
        
        
                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link scrollto @yield('home')" href="{{ route('index')}}">Home</a></li>
                        <li><a class="nav-link scrollto @yield('grave')" href="{{ route('grave')}}">Gravesite Look Up</a></li>
                        <li><a class="nav-link scrollto @yield('contact')" href="{{ route('contact')}}">Contact Us</a></li>

                        @if(Auth::user() && Auth::user()->role == 'customer')
                            <li class="dropdown">
                                <a class="getstarted scrollto" href="">
                                    {{ ucwords(Auth::user()->first_name) }}
                                    {{ ucwords(Auth::user()->middle_name) }}
                                    {{ ucwords(Auth::user()->last_name) }}
                                    {{ Auth::user()->suffix ? ' ' . Auth::user()->suffix : '' }}
                                    <i class="bi bi-chevron-down"></i></a>
                                <ul>
                                <li><a href="{{ route('profile.user') }}">Profile</a></li>
                                <li><a href="">My Lots</a></li>
                                <li><a href="{{ route('reserve') }}">Reserved Lots</a></li>
                                {{-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                    <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                    </ul>
                                </li> --}}
                                <li><a href="#">Change Password</a></li>
                                <li><a href="{{ route('logout')}}">Logout</a></li>
                                </ul>
                            </li>
                        @else
                            <li><a class="getstarted scrollto" href="{{ route('login')}}">Login</a></li>
                            <li><a class="getstarted scrollto" href="{{ route('signup')}}">Sign Up</a></li>
                        @endif
                        
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
        
            </div>
        </header>
        <!-- End Header -->
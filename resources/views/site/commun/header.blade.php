<header id="header" class="d-flex align-items-center bg-light">
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <h1 class="text-light"><a href="{{ route('home') }}">Jl Prado</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="active" href="{{ route('home') }}">Home</a></li>
                <li class="dropdown">
                    <a href="#">
                        <span>Services</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        @foreach ( $brands as $brand)
                            <li>
                                <a href="{{ url($brand->url) }}" class="text-uppercase">{{ $brand->brand }} - {{ $brand->service->service }}</a>
                            </li>
                        @endforeach

                        {{-- <li class="dropdown">
                            <a href="#">
                                <span>Deep Drop Down</span>
                                <i class="bi bi-chevron-right"></i>
                            </a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li><a href="#">Drop Down 2</a></li> --}}
                    </ul>
                </li>
                <li><a href="{{ route('team') }}">Team</a></li>
                <li><a href="{{ route('faqs') }}">Faqs</a></li>
                <li><a href="{{ route('testimonials') }}">Testimonials</a></li>
                {{-- <li class="dropdown">
                    <a href="#">
                        <span>Drop Down</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li> --}}
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li class="dropdown">
                    <a href="#">
                        <span>Language</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        <li><a href="#" class="text-uppercase">Spanish</a></li>
                        <li><a href="#" class="text-uppercase">English</a></li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>

</header>
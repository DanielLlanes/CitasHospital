<header id="header" class="d-flex align-items-center bg-light">
    <div class="container d-flex justify-content-between">
        <div class="logo">
            <h1 class="text-light"><a href="{{ route('home') }}">Jl Prado</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="active" href="{{ route('home') }}">@lang('site/menu.Home')</a></li>
                <li class="dropdown">
                    <a href="#">
                        <span>@lang('site/menu.Services')</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        @foreach ( $brands as $brand)
                            @if (count($brand->service->procedures) > 0)
                                <li>
                                    <a href="{{ url($brand->url) }}" class="text-uppercase">{{ $brand->brand }} - {{ $brand->service->service }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
               {{--  <li><a href="{{ route('team') }}">@lang('site/menu.Team')</a></li>
                <li><a href="{{ route('facilities') }}">@lang('site/menu.Facilities')</a></li>
                <li><a href="{{ route('faqs') }}">@lang('site/menu.Faqs')</a></li> --}}
                {{-- <li><a href="{{ route('testimonials') }}">@lang('site/menu.Testimonials')</a></li> --}}
                <li class="dropdown">
                    <a href="#">
                        <span>@lang('site/menu.Testimonials')</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                       {{--  @foreach ($brands as $brand)
                            <li class="dropdown"><a href="#"><span class="text-uppercase">{{ $brand->acronym }} - {{ $brand->brand }}</span> <i class="bi bi-chevron-right"></i></a>
                                <ul class="text-uppercase">
                                    <li><a href="{{ route('testimonials', ['brand'=> $brand->url, 'media'=> 'image']) }}" class="text-uppercase">Images - {{ (app()->getLocale() == "en") ?  "Before - after":"Antes -Después"}}</a></li>
                                    <li><a href="{{ route('testimonials', ['brand'=> $brand->url, 'media'=> 'video']) }}" class="text-uppercase">Videos - {{ (app()->getLocale() == "en") ?  "Testimonials":"Testimonios"}}</a></li>
                                </ul>
                            </li>
                        @endforeach --}}
                        {{-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 1</a></li> --}}
                    </ul>
                </li>
                {{-- <li><a href="{{ route('contact') }}">@lang('site/menu.Contact')</a></li> --}}
                {{-- <li><a href="{{ route('blog') }}">@lang('site/menu.Blog')</a></li> --}}
                <li class="dropdown">
                    <a href="#">
                        <span>@lang('site/menu.Financing')</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="https://hipaa.jotform.com/Citerra/loan-application" target="_blank" class="text-uppercase">
                                @lang('Citerra')
                            </a>
                        </li>
                        <li>
                            <a href="https://www.unitedcredit.com/start-an-application/?pid=0010L00001kXhrY" target="_blank" class="text-uppercase">
                                @lang('United Medical Credit')
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">
                        <span>@lang('site/menu.Language')</span>
                        <i class="bi bi-chevron-down"></i>
                    </a>
                   {{--  <ul>
                        <li>
                            <a href="{{ (app()->getLocale() == 'es') ? 'javascript:;' : route("language", "es") }}" class="text-uppercase">
                                @lang('site/menu.Spanish')
                            </a>
                        </li>
                        <li>
                            <a href="{{ (app()->getLocale() == 'en') ? 'javascript:;' : route("language", "en") }}" class="text-uppercase">
                                @lang('site/menu.English')
                            </a>
                        </li>
                    </ul>
                </li>
            </ul> --}}
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>

</header>

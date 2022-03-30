@extends('site.layouts.app')
@section('title')
@endsection
@section('content')

@include('site.trans.home')

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            <div class="carousel-item active" style="background-image: url({{ asset('siteFiles/assets/img/slide/slide-1.jpg') }});">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>@lang('site/home.Welcome to') <span>J.L. Prado</span></h2>
                        <p><br></p>

                        <a href="#about" class="btn-get-started scrollto">@lang('site/home.Get Started')</a>
                        <a href="https://www.youtube.com/watch?v=0ZbRiVwx87Q" class="glightbox btn-watch-video">
                            <i class="bi bi-play-circle"></i>
                            <span>@lang('site/home.Watch Video')</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background-image: url({{ asset('siteFiles/assets/img/slide/slide-2.jpg') }});">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>@lang('site/home.Welcome to') <span>J.L. Prado</span></h2>
                        <p><br></p>
                        <a href="#about" class="btn-get-started scrollto">@lang('site/home.Get Started')</a>
                        <a href="https://www.youtube.com/watch?v=0ZbRiVwx87Q" class="glightbox btn-watch-video">
                            <i class="bi bi-play-circle"></i>
                            <span>@lang('site/home.Watch Video')</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" style="background-image: url({{ asset('siteFiles/assets/img/slide/slide-3.jpg') }});">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>@lang('site/home.Welcome to') <span>J.L. Prado</span></h2>
                        <p><br></p>
                        <a href="#about" class="btn-get-started scrollto">@lang('site/home.Get Started')</a>
                        <a href="https://www.youtube.com/watch?v=0ZbRiVwx87Q" class="glightbox btn-watch-video">
                            <i class="bi bi-play-circle"></i>
                            <span>@lang('site/home.Watch Video')</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section>
<!-- End Hero -->

<main id="main">
    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                {!! (Cookie::get('PublicLang') == "en") ? '<h2>About <strong>Us</strong></h2>': '<h2>Sobre <strong>Nosotros</strong></h2>'  !!}
            </div>
            <div class="row no-gutters">
                <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start p-5" data-aos="fade-right" style="background: url('https://jlpradosc.com/wp-content/uploads/2020/09/jlprado-img-logo-footer.png') center no-repeat;"></div>
                <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
                    <div class="content d-flex flex-column justify-content-around p-3">
                        {!! aboutUs(Cookie::get('PublicLang')) !!}
                    </div>
                </div>
            </div>
            <div class="col-12 my-3">
                {!! aboutUs(Cookie::get('PublicLang')) !!}
            </div>
        </div>
    </section>
    <!-- End About Us Section -->

    <!-- ======= About Boxes Section ======= -->
    <section id="about-boxes" class="about-boxes">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <img src="{{ asset('siteFiles/assets/img/about-boxes-1.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-icon">
                            <i class="bi bi-brush bg-main"></i>
                        </div>
                        <div class="card-body">
                            {!! ourMission(Cookie::get('PublicLang')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <img src="{{ asset('siteFiles/assets/img/about-boxes-2.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-icon">
                            <i class="bi bi-brush bg-main"></i>
                        </div>
                        <div class="card-body">
                            {!! ourPlan(Cookie::get('PublicLang')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <img src="{{ asset('siteFiles/assets/img/about-boxes-3.jpg') }}" class="card-img-top" alt="...">
                        <div class="card-icon">
                            <i class="bi bi-brush bg-main"></i>
                        </div>
                        <div class="card-body">
                            {!! ourVision(Cookie::get('PublicLang')) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End About Boxes Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section section-bg">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                {!! ourBrands(Cookie::get('PublicLang')) !!}
            </div>
            
            <div class="row">
                @foreach ($brands as $brand)
                    <div class="col-sm-4 mb-1 mb-lg-3" data-aos="fade-up">
                        <a href="{{ url($brand->url) }}">
                            <div class="card border-0 bg-transparent bg-transparent">
                                <img src="{{ getBrandImage($brand) }}" class="card-img-top" height="230" width="380" style="text-transform: lowercase;" alt="{{ strtolower($brand->service->service) }}">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{ $brand->service->service}}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- End Services Section -->

    <!-- ======= Our Cordinators Section ======= -->
    <section id="cordinator" class="cordinator">

        <div class="container">
            <div class="section-title" data-aos="fade-up">
                {!! ourCoordinatos(Cookie::get('PublicLang')) !!}
            </div>

            <div class="splide" id="splide" data-aos="fade-up">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($coordinators as $coordinator)
                            <li class="splide__slide">
                                <div class="member d-flex align-items-start">
                                    <div class="pic">
                                        <img src="{{ getAvatar($coordinator) }}" class="img-fluid" alt="{{ $coordinator->name }}">
                                    </div>
                                    <div class="member-info">
                                        <h4>{{ $coordinator->name }}</h4>
                                        <span>Coordinator</span>
                                        <p style="margin-block-end: 0"><a href="tel:{{ $coordinator->cellphone }}">Call me</a></p>
                                        <p><a href="mailto:{{ $coordinator->email }}">@lang('Send me a email')</a></p>
                                        <div class="mt-3">
                                            @foreach($coordinator->assignToService as $service)
                                            <a style="text-decoration: none" href="{{ asset($service->brand->url) }}" class="me-2">{{ $service->service }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
    </section>
    <!-- End Our Cordinators Section -->
</main>
@endsection


@section('scripts')
    @if (\Session::has('sys-message'))
        <script>
            Toast.fire({
              icon: '{{\Session::get('icon')}}',
              title: '{{\Session::get('msg')}}',
            })
            var data = {!! json_encode(\Session::get('data')) !!}
            
            socket.emit('sendNewNotificationToServer', data);
            socket.emit('updateDataTablesToServer');
        </script>
    @endif

    <script>
        new Splide('.splide', {
            type: 'loop',
            perPage: 2,
            perMove: 1,
            autoplay: true,
            breakpoints: {
                640: {
                    perPage: 1,
                },
            }
        }).mount();
    </script>
@endsection

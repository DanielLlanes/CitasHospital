@extends('site.layouts.app')
@section('title')
@endsection
@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <div class="carousel-inner" role="listbox">

            <!-- Slide 1 -->
            <div class="carousel-item active" style="background-image: url({{ asset('siteFiles/assets/img/slide/slide-1.jpg') }});">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>Welcome to <span>JL Prado</span></h2>
                        <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et
                            tempore modi architecto.</p>

                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=0ZbRiVwx87Q" class="glightbox btn-watch-video">
                            <i class="bi bi-play-circle"></i>
                            <span>Watch Video</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background-image: url({{ asset('siteFiles/assets/img/slide/slide-2.jpg') }});">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>Welcome to <span>JL Prado</span></h2>
                        <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et
                            tempore modi architecto.</p>
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=0ZbRiVwx87Q" class="glightbox btn-watch-video">
                            <i class="bi bi-play-circle"></i>
                            <span>Watch Video</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" style="background-image: url({{ asset('siteFiles/assets/img/slide/slide-3.jpg') }});">
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>Welcome to <span>JL Prado</span></h2>
                        <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et
                            tempore modi architecto.</p>
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=0ZbRiVwx87Q" class="glightbox btn-watch-video">
                            <i class="bi bi-play-circle"></i>
                            <span>Watch Video</span>
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
                <h2>About <strong>Us</strong></h2>
            </div>
            <div class="row no-gutters">
                <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" style="background: url('http://jlpradosc.com/wp-content/uploads/2020/09/jlprado-img-about-us.jpg') center/cover no-repeat;"></div>
                <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
                    <div class="content d-flex flex-column justify-content-around p-3">
                        <p data-aos="fade-up" class="pb-3">
                            We are a family owned medical company who demands the highest quality standards to all doctors and staff that wants to be part of us so we can obtain the best results and offer them to people who are in search of a better and healthier life. Our father
                            founded this company in 1985, he was an international recognized plastic surgeon, passed away in 1999.
                        </p>
                        <p data-aos="fade-up" class="pb-3">
                            We took over his legacy to continue expanding his work to new horizons, In his honor we have created different medical programs to continue helping people. We have an excellent team because our doctors, nurses, administratives, patient coordinators, drivers
                            and other staff are hired once they qualify with our strict requirements and high standards.
                        </p>
                        <p data-aos="fade-up" class="pb-3">
                            With our medical specialties we have dedicated years on performing medical procedures that have changed the life of thousands of people, helping them to obtain a healthier life and making them feel more secure about themselves.
                        </p>
                    </div>
                    <!-- End .content-->
                </div>
            </div>
            <div class="col-12 my-3">
                <h5>
                    One of our mayor concerns is to offer an excellent service and care avoiding any possible risk at all times. Our patients wellbeing is our main priority.
                </h5>
                <h5>
                    Everyone of our patients has trusted us and now have become our family. We invite you to come and join us with your trust and become a part of our family. We guarantee that you’ll be in the best hands.
                </h5>
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
                            <h5 class="card-title text-main">
                                Our Mission
                            </h5>
                            <p class="card-text">
                                Help people change their lives by improving their physical, mental and emotional health in a friendly and helpful environment.
                            </p>
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
                            <h5 class="card-title text-main">
                                Our Plan
                            </h5>
                            <p class="card-text">
                                <ul>
                                    <li>Excellence</li>
                                    <li>Transparency</li>
                                    <li>Difference</li>
                                    <li>Responsibility</li>
                                    <li>Resolution</li>
                                    <li>Passion</li>
                                    <li>Loyalty</li>
                                </ul>
                            </p>
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
                            <h5 class="card-title text-main">
                                Our Vision
                            </h5>
                            <p class="card-text">
                                To be a hospital recognized for its excellence in medical care, generation of knowledge through research, as well as the training and development of human resources in health.
                            </p>
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
                <h2>Our <strong>Brands</strong></h2>
            </div>

            <div class="row">
                @foreach ($brands as $brand)
                    <div class="col-sm-4 mb-1 mb-lg-3" data-aos="fade-up">
                        <a href="{{ url($brand->url) }}">
                            <div class="card border-0 bg-transparent bg-transparent">
                                <img src="{{ asset($brand->image) }}" class="card-img-top" alt="...">
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
                <h2>Our <strong>Cordinators</strong></h2>
            </div>

            <div class="splide" id="splide" data-aos="fade-up">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($coordinators as $coordinator)
                        <li class="splide__slide">
                            <div class="member d-flex align-items-start">
                                <div class="pic"><img src="{{ asset($coordinator->avatar) }}" class="img-fluid" alt="{{ $coordinator->name }}"></div>
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

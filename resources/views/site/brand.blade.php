@extends('site.layouts.app')
@section('title')
 - {{ $brand->brand }}
@endsection
@section('content')

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-capitalize">{{ $brand->brand }}</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>{{ $brand->brand }}</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <section id="team" class="team section-bg">
        <div class="container">

            <div class="section-title m-5" data-aos="fade-up">
                <h2><strong>{{ $brand->service->service }}</strong></h2>
                <p>
                    All of our doctors are certified surgeons with extensive experience in various surgical procedures. At JLP Surgical Center, the safety, well-being and quality of our service are the first commitment with our patients.
                </p>
            </div>

            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="doctor" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('siteFiles/assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                        <div class="doctor-info">
                            <div class="doctor-info-content">
                                <h4>Lex Lutor</h4>
                                <span>Plastic Surgeon</span>
                            </div>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6" data-wow-delay="0.1s">
                    <div class="doctor" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{ asset('siteFiles/assets/img/team/team-2.jpg') }}" class="img-fluid" alt="">
                        <div class="doctor-info">
                            <div class="doctor-info-content">
                                <h4>Selina Kyle</h4>
                                <span>Plastic Surgeon</span>
                            </div>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6" data-wow-delay="0.2s">
                    <div class="doctor" data-aos="fade-up" data-aos-delay="300">
                        <img src="{{ asset('siteFiles/assets/img/team/team-3.jpg') }}" class="img-fluid" alt="">
                        <div class="doctor-info">
                            <div class="doctor-info-content">
                                <h4>Wally West</h4>
                                <span>Bariatric General Surgeon</span>
                            </div>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 col-md-6" data-wow-delay="0.3s">
                    <div class="doctor" data-aos="fade-up" data-aos-delay="400">
                        <img src="{{ asset('siteFiles/assets/img/team/team-4.jpg') }}" class="img-fluid" alt="">
                        <div class="doctor-info">
                            <div class="doctor-info-content">
                                <h4>Barbara Gordon</h4>
                                <span>Accountant</span>
                            </div>
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

@endsection

@extends('site.layouts.app')
@section('title')
 - Testimonials
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Testimonials</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Testimonials</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container">

            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Our<strong> Testimonials</strong></h2>
                <p>
                    All of our doctors are certified surgeons with extensive experience in various surgical procedures. At JLP Surgical Center, the safety, well-being and quality of our service are the first commitment with our patients.
                </p>
            </div>

            <div class="row">

                <div class="col-lg-6" data-aos="fade-up">
                    <div class="card">
                        <div class="card-video position-relative">
                            <div class="card-thumbnail">
                                <img src="https://img.youtube.com/vi/8FM3P9DXslQ/maxresdefault.jpg" class="card-img-top" alt="... ">
                            </div>
                            <div class="card-btn position-absolute">
                                <a href="https://www.youtube.com/watch?v=8FM3P9DXslQ" class="glightbox button">
                                    <i class=" bi bi-play "></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-up">
                    <div class="card">
                        <div class="card-video position-relative">
                            <div class="card-thumbnail">
                                <img src="https://img.youtube.com/vi/0ZbRiVwx87Q/maxresdefault.jpg " class="card-img-top" alt="... ">
                            </div>
                            <div class="card-btn position-absolute">
                                <a href="https://www.youtube.com/watch?v=0ZbRiVwx87Q" class="glightbox button ">
                                    <i class=" bi bi-play "></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonials Section -->

</main>
<!-- End #main -->
@endsection

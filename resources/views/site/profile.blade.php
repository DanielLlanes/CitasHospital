@extends('site.layouts.app')
@section('title')
 - profile
@endsection
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>profile</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>profile</li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Our profile Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title m-5" data-aos="fade-up">
                    <h2>Our<strong> Doctors</strong></h2>
                    <p>
                        All of our doctors are certified surgeons with extensive experience in various surgical procedures. At JLP Surgical Center, the safety, well-being and quality of our service are the first commitment with our patients.
                        {{ url() }}
                    </p>
                </div>

                <div class="row">
                    @foreach($doctors as $doctor)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="doctor" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset($doctor->avatar) }}" class="img-fluid" alt="">
                                <div class="doctor-info">
                                    <div class="doctor-info-content">
                                        <h4>{{ $doctor->name }}</h4>
                                        @foreach($doctor->specialties as $spcialty)
                                        <span>{{ $spcialty->name_en }}</span>
                                        @endforeach
                                        <a class="btn btn-primary btn-sm" href="{{ url($doctor->url) }}">View profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Team Section -->
    </main>
@endsection

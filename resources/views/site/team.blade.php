@extends('site.layouts.app')
@section('title')
 - Team
@endsection
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Team</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Team</li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->
        <!-- ======= Our Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title m-5" data-aos="fade-up">
                    <h2>Our<strong> Doctors</strong></h2>
                    <p>
                        All of our doctors are certified surgeons with extensive experience in various surgical procedures. At JLP Surgical Center, the safety, well-being and quality of our service are the first commitment with our patients.

                    </p>
                </div>


                @foreach ($titles as $title)
                    <div class="section-title m-5" data-aos="fade-up">
                        <h2><strong> {{ $title->specialty }} </strong></h2>
                    </div>
                    <div class="row">
                        @foreach ($doctors as $doctor)
                            @foreach ($doctor->specialties as $spe)
                                @if ($spe->id == $title->id)
                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="doctor" data-aos="fade-up" data-aos-delay="100">
                                                <img src="{{ asset($doctor->avatar) }}" class="img-fluid" alt="">
                                                <div class="doctor-info">
                                                    <div class="doctor-info-content" style="left: 0;">
                                                        <h4>{{ $doctor->name }}</h4>
                                                        @foreach($doctor->specialties as $spcialty)
                                                        <span>{{ $spcialty->specialty }}</span>
                                                        @endforeach
                                                        <a class="btn btn-primary btn-sm mt-3" href="{{ route('team', $doctor->url) }}">View profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="100">
                                                {{ $doctor->name }}
                                            </div>
                                        </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
        <!-- End Team Section -->
    </main>
@endsection

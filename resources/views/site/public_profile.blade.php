@extends('site.layouts.app')
@section('title')
 - Public profile
@endsection
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>{{ $doctor->name }}</h2>
                    <ol>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('team') }}">Team</a> </li>
                        <li> {{ $doctor->name }}</li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Our Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title m-5" data-aos="fade-up">
                    <h2>{{ $doctor->roles[0]->Rname }}<strong> {{ $doctor->name }}</strong></h2>
                    @if (count($doctor->careerobjetive) > 0)
                        {!! $doctor->careerobjetive[0]->career_objective !!}
                    @endif
                </div>
                <div class="row">
                    <div class="col-12 col-md-3" data-aos="fade-up">
                        <img src="{{ asset( getAvatar($doctor) ) }}" class="img-thumbnail rounded-circle" alt="{{ $doctor->name }}">
                        <div class="doc-info mt-3">
                            <h5 class="text-uppercase text-center">specialties</h5>
                            @if (count($doctor->specialties) > 0)
                                @foreach ($doctor->specialties as $specialty)
                                    <p>{{ $specialty->Sname }}</p>
                                @endforeach
                                <h5 class="text-uppercase text-center">Services</h5>
                                @foreach ($doctor->assignToService as $sercice)
                                    <p>{{ $sercice->service }}</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        @if (count($doctor->workhistory) > 0)
                            <div class="section-title" data-aos="fade-up">
                                <h2>Work<strong> History</strong></h2>
                            </div>
                            <div class="col-12 mb-3" data-aos="fade-up">
                                @foreach ($doctor->workhistory as $workhistory)
                                <span class="text-left">
                                    <strong>Job:</strong> {{ $workhistory->job_title }}
                                    <br>
                                    <strong>Company:</strong> {{ $workhistory->job_company }}
                                    <br>
                                    <strong>from:</strong> {{ date('Y', strtotime($workhistory->job_from_year)) }} <strong>-</strong>
                                    <strong>To:</strong> {{ date('Y', strtotime($workhistory->job_to_year)) }}
                                    <br>
                                    {!! $workhistory->job_notes !!}
                                </span>
                                @endforeach
                            </div>
                        @endif

                        @if (count($doctor->educationbackground) > 0)
                            <hr class="mt-3 mb-1" data-aos="fade-up">
                            <div class="section-title mt-3" data-aos="fade-up">
                                <h2>Education<strong> BackGround</strong></h2>
                            </div>
                            <div class="col-12" data-aos="fade-up">
                                @foreach ($doctor->educationbackground as $educationbackground)
                                <span class="text-left">
                                    <strong>title:</strong> {{ $educationbackground->education_title }}
                                    <br>
                                    <strong>School:</strong> {{ $educationbackground->education_school }}
                                    <br>
                                    <strong>from:</strong> {{ date('Y', strtotime($educationbackground->education_from_year)) }} <strong>-</strong>
                                    <strong>To:</strong> {{ date('Y', strtotime($educationbackground->education_to_year)) }}
                                    <br>
                                    {!! $educationbackground->education_notes !!}
                                </span>
                                @endforeach
                            </div>
                        @endif

                        @if (count($doctor->postgraduatestudies) > 0)
                            <hr class="mt-3 mb-1" data-aos="fade-up">
                            <div class="section-title mt-3" data-aos="fade-up">
                                <h2>Posgraduate<strong> Studies</strong></h2>
                            </div>
                            <div class="col-12"  data-aos="fade-up">
                                @foreach ($doctor->postgraduatestudies as $postgraduatestudies)
                                <span class="text-left">
                                    <strong>title:</strong> {{ $postgraduatestudies->postgraduate_title }}
                                    <br>
                                    <strong>School:</strong> {{ $postgraduatestudies->postgraduate_school }}
                                    <br>
                                    <strong>from:</strong> {{ date('Y', strtotime($postgraduatestudies->postgraduate_from_year)) }} <strong>-</strong>
                                    <strong>To:</strong> {{ date('Y', strtotime($postgraduatestudies->postgraduate_to_year)) }}
                                    <br>
                                    {!! $postgraduatestudies->postgraduate_notes !!}
                                </span>
                                @endforeach
                            </div>
                        @endif

                        @if (count($doctor->updatecourses) > 0)
                            <hr class="mt-3 mb-1" data-aos="fade-up">
                            <div class="section-title mt-3" data-aos="fade-up">
                                <h2>Update<strong> Courses</strong></h2>
                            </div>
                            <div class="col-12 row"  data-aos="fade-up">
                                @foreach ($doctor->updatecourses as $updatecourse)
                                <span class="text-left col-4">
                                    <strong>title:</strong> {{ $updatecourse->course_title }}
                                    <br>
                                    <strong>School:</strong> {{ $updatecourse->course_school }}
                                    <br>
                                    <strong>Year:</strong> {{ date('Y', strtotime($updatecourse->course_year)) }}
                                    <br>
                                </span>
                                @endforeach
                            </div>
                        @endif

                        @if (count($doctor->imageMany) > 0)
                            <hr class="mt-3 mb-1" data-aos="fade-up">
                            <div class="row">
                                @if (count($doctor->imageMany) > 0)
                                    @foreach ($doctor->imageMany as $img)
                                        <div class="col-12 col-md-3" data-aos="fade-up">
                                            <div class="card">
                                                <a href="{{ asset($img->image) }}" data-effect="mfp-zoom-in" class="a" title="{{ $img->title }}">
                                                    <img src="{{ asset($img->image) }}" class="card-img-top" alt="{{ $img->title }}">
                                                </a>
                                                <div class="card-body pb-0">
                                                    <h5 class="card-title text-center">{{ $img->title }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endif
                        @if (count($doctor->surgeryperformed) > 0)
                        <hr class="mt-3 mb-1" data-aos="fade-up">
                        <div class="row justify-content-center">
                            @foreach ($doctor->surgeryPerformed as $item)
                                <div class="col-12 col-md-3">
                                    <div class="card border-0" style="background: transparent!important">
                                        <div class="card-body">
                                            <h4 class="card-title text-center">{{ $item->surgery_title }}</h4>
                                            <h5 class="card-text text-center mt-5">
                                                <span class="info-box-number countAnimation" data-counter="counterup" data-value="{{ $item->surgery_number }}">{{ $item->surgery_number }}</span>
                                            </h5>
                                          </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- End Team Section -->
    </main>
@endsection
@section('scripts')
    <script>
        $('.card').magnificPopup({
            delegate: 'a.a',
            type: 'image',
            removalDelay: 500,
            callbacks: {
                beforeOpen: function() {
                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                    this.st.mainClass = this.st.el.attr('data-effect');
                }
            },
            closeOnContentClick: true,
            midClick: true
        });
        window.addEventListener('DOMContentLoaded', () => {
            $('.countAnimation').counterUp({
                delay: 10,
                time: 1000
            });
        });

    </script>
@endsection

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


                @foreach ($testimonials as $element)
                    <div class="col-lg-4" data-aos="fade-up">
                        <div class="card border-0" style="width: 18rem;">
                            <img src="{{ asset($element->imageOne->image) }}" class="card-img-top" height="250px" alt="...">
                            <div class="card-body p-0">{{-- 
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach

                

                <div class="col-12 mt-5 d-flex justify-content-end">
                    {!! $testimonials->links('vendor.pagination.bootstrap-4') !!}
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonials Section -->

</main>
<!-- End #main -->
@endsection

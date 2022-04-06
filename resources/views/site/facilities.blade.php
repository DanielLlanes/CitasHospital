@extends('site.layouts.app')
@section('title')
 - Facilities
@endsection
@include('site.trans.facilities')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Facilities</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Facilities</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Facilities Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container">

            {!! facilities(app()->getLocale()) !!}
        </div>
    </section>
    <!-- End Testimonials Section -->

</main>
<!-- End #main -->
@endsection

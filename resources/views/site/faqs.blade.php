@extends('site.layouts.app')
@section('title')
 - Faqs
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Contact</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Faqs</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Faqs Section ======= -->
    <section id="team" class="">
        <div class="container">

            <div class="section-title m-5" data-aos="fade-up">
                <h2>Faq<strong>s</strong></h2>
                <p>
                    All of our doctors are certified surgeons with extensive experience in various surgical procedures. At JLP Surgical Center, the safety, well-being and quality of our service are the first commitment with our patients.
                </p>
            </div>

            <div class="row">
                @if (!empty($faqs) && count($faqs))
                <div class="row">
                    <div class="col-12 mb-5">
                        <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="bi bi-search"></i></div>
                                <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Search">
                            </div>
                        </div>
                    </div>
                    @for ($i = 0; $i < count($faqs); $i++)
                        <div class="col-sm-6">
                            <div class="card bg-transparent border-0">
                                <div class="card-body">
                                    <h5 class="card-title text-main">{{ ($i+1) }}.- {{ $faqs[$i]->question }}</h5>
                                    <p class="card-text">{{ $faqs[$i]->awnser }}</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                @else
                    <h1 class="text-center">@lang('Coming soon')</h1>
                @endif
            </div>

        </div>
    </section>
    <!-- End Faqs Section -->
</main>
@endsection

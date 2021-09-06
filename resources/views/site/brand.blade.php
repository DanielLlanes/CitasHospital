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
                <h2 class="text-capitalize fw-bold">{{ $brand->brand }}</h2>
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>{{ $brand->brand }}</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->
    {{ $products }}
    @if (count($products) > 0)
        <section id="team" class="team">
            <div class="container">

                <div class="section-title m-5" data-aos="fade-up">
                    <h2><strong>{{ $brand->service->service }}</strong></h2>
                    <p>
                        {{ $brand->service->description }}
                    </p>
                </div>
                @foreach ($title as $item)
                    <div class="section-title m-5 mb-0" data-aos="fade-up">
                        <h2><strong>{{ $item->procedure->procedure }}</strong></h2>
                        <p>
                            {{ $item->procedure->description }}
                        </p>
                    </div>
                    <div class="row" data-aos="fade-up">
                        @foreach ($products as $product)
                        @if ($product->procedure->procedure === $item->procedure->procedure)
                                <div class="col-sm-3 mb-3 mb-md-0" data-aos="fade-up">
                                    <div class="card">
                                        @if (!is_null($product->procedure->image))
                                            <img src="{{ asset($product->procedure->image) }}" class="card-img-top" alt="..." style="height: 200px">
                                        @endif
                                        <div class="card-body">
                                            <h4 class="card-title text-center">{{ $product->procedure->procedure }}</h4>
                                            <h5 class="card-title text-center" style="color: {{ $product->brand->color }}">{{ is_null($product->package_id) ? '' : $product->package->package }}</h5>
                                            <h6 class="card-title text-center">{{ is_null($product->price) ? '' : '$ '.$product->price }}</h6>
                                            <p class="card-text">{!! $product->description !!}</p>

                                        </div>
                                    <a href="{{ route('appIndex', ['id' => $product->id]) }}" class="btn btn-main btn-block btn-sm text-uppercase"><i class="bi bi-clipboard-check me-3"></i> apply now</a>
                                    </div>
                                </div>
                        @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
    @else
    <section id="team" class="team">
        <div class="container">
            <div class="section-title m-5" data-aos="fade-up">
                <h2><strong>Cooming soon</strong></h2>
                <p>
                    Come back soon to see our amazing procedures
                </p>
            </div>
        </div>
    </section>
    @endif
</main>

@endsection

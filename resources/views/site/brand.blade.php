@extends('site.layouts.app')
@section('title')
 - {{ $brand->brand }}
@endsection
@section('styles')
    <style>
        .summer p{
            line-height: 0.2!important;
        }
    </style>
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
    @if (count($treatments) > 0)
        <section id="team" class="team">
            <div class="container">

                <div class="section-title m-5" data-aos="fade-up">
                    <h2><strong>{{ $brand->service->service }}</strong></h2>
                    <p>
                        @if (!is_null($brand->service->descriptionOne))
                            {!! $brand->service->descriptionOne->description !!}
                        @endif
                    </p>
                </div>
                @foreach ($title as $item)
                    <div class="section-title m-5 mb-0" data-aos="fade-up">
                        <h2><strong>{{ $item->procedure->procedure }}</strong></h2>
                        <p>
                            @if (!is_null($item->procedure->descriptionOne))
                                {!! $item->procedure->descriptionOne->description !!}
                            @endif
                        </p>
                    </div>
                    <div class="row" data-aos="fade-up">
                        @foreach ($treatments as $treatment)
                        @if ($treatment->procedure->procedure === $item->procedure->procedure)
                                <div class="col-sm-3 mb-3 mb-md-0" data-aos="fade-up">
                                    <div class="card altura">
                                        <img src="{{ asset( getTreamentImage($treatment)) }}" class="card-img-top" alt="{{ $treatment->procedure->procedure }}" style="height: 200px">
                                        <div class="card-body">
                                            <h4 class="card-title text-center">{{ $treatment->procedure->procedure }}</h4>
                                            <h5 class="card-title text-center" style="color: {{ $treatment->brand->color }}">{{ is_null($treatment->package_id) ? '' : $treatment->package->package }}</h5>
                                            <h6 class="card-title text-center">{{ is_null($treatment->price) ? '' : '$ '.$treatment->price }}</h6>
                                            <p class="card-text"></p>
                                            <span class="summer">
                                                <ul>
                                                    @foreach ($treatment->contains as $include)
                                                        <li>{{ $include->include }}</li>
                                                    @endforeach
                                                </ul>
                                            </span>
                                        </div>
                                    <a href="{{ route('appIndex', ['id' => $treatment->id]) }}" class="btn btn-main btn-block btn-sm text-uppercase"><i class="bi bi-clipboard-check me-3"></i> apply now</a>
                                    </div>
                                </div>
                        @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>
        <section id="team" class="team section-bg">
            <div class="container">

                <div class="section-title m-5" data-aos="fade-up">
                    <h2>Our<strong> Doctors</strong></h2>
                    <p>
                        All of our doctors are certified surgeons with extensive experience in various surgical procedures. At JLP Surgical Center, the safety, well-being and quality of our service are the first commitment with our patients.
                    </p>
                </div>
                <code>
                    
                </code>
                <div class="row">
                    @foreach($doctors as $doctor)
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="doctor" data-aos="fade-up" data-aos-delay="100">
                                <img src="{{ asset( getAvatar($doctor) ) }}" class="img-fluid" alt="">
                                <div class="doctor-info">
                                    <div class="doctor-info-content" style="left: 0;">
                                        <h4>{{ $doctor->name }}</h4>
                                        @foreach($doctor->specialties as $spcialty)
                                        <span>{{ $spcialty->name_en }}</span>
                                        @endforeach
                                        <a class="btn btn-primary btn-sm mt-3" href="{{ route('team', $doctor->url) }}">View profile</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="100">
                                {{ $doctor->name }}
                            </div>
                        </div>
                    @endforeach
                </div>
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

@section('scripts')
    <script>
        var altura_arr = [];//CREAMOS UN ARREGLO VACIO
        $('.altura').each(function(){//RECORREMOS TODOS LOS CONTENEDORES DE LAS IMAGENES, DEBEN TENER LA MISMA CLASE
            var altura = $(this).height(); //LES SACAMOS LA ALTURA
            altura_arr.push(altura);//METEMOS LA ALTURA AL ARREGLO
        });
        altura_arr.sort(function(a, b){return b-a}); //ACOMODAMOS EL ARREGLO EN ORDEN DESCENDENTE
        $('.altura').each(function(){//RECORREMOS DE NUEVO LOS CONTENEDORES
            $(this).css('height',altura_arr[0]);//LES PONEMOS A TODOS LOS CONTENEDORES EL PRIMERO ELEMENTO DE ALTURA DEL ARREGLO, QUE ES EL MAS GRANDE.
        });
    </script>   
@endsection

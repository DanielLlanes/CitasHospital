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
                    <img src="{{ getBrandImage($brand) }}" alt="{{ $brand->service->service }}" class="img-fluid w-75">
                </div>
                @foreach ($title as $item)
                    <div class="section-title m-5 mb-0" data-aos="fade-up">
                        <h2><strong>{{ $item->procedure->procedure }}</strong></h2>
                        <p>
                            @if (!is_null($item->procedure->descriptionOne))
                                {!! $item->procedure->descriptionOne->description !!}
                            @endif
                        </p>
                        @if (!is_null($item->procedure->imageOne))
                            <span class="images">
                                <a href="{{ asset($item->procedure->imageOne->image ) }}" data-effect="mfp-zoom-in" class="a">
                                    <img src="{{ asset($item->procedure->imageOne->image ) }}" class="img-thumbnail w-50" alt="{{ $item->procedure->procedure }}">
                                </a>
                            </span>
                        @endif
                    </div>
                    <style>
                        .altura {
                            transition: box-shadow .3s;
                        }
                        .altura:hover {
                            box-shadow: 1px -1px 17px 2px rgba(33,33,33,.2);
                        }
                        .btn-apply{
                            transition: box-shadow .3s;
                            display: block;
                        }
                        .altura:hover .btn-apply{
                            box-shadow: 1px -1px 17px 2px rgba(33,33,33,.2);
                        }
                    </style>
                    <div class="row justify-content-center" data-aos="fade-up">
                        @foreach ($treatments as $treatment)
                        @php
                            if ($treatment->discountType == 'porcent') {
                                $discountPrice = ($treatment->price * $treatment->discount) / 100;
                            }

                            if ($treatment->discountType == 'money') {
                                $discountPrice = ($treatment->price - $treatment->discount);
                            }
                        @endphp
                        @if ($treatment->procedure->procedure === $item->procedure->procedure)
                                <div class="col-sm-3 mb-3 mb-md-0" data-aos="fade-up">
                                    <div class="card altura mb-5">
                                       {{--  <img src="{{ asset( getTreamentImage($treatment)) }}" class="card-img-top" alt="{{ $treatment->procedure->procedure }}" style="height: 200px"> --}}
                                        <div class="card-body">
                                            <h4 class="card-title text-center">{{ $treatment->procedure->procedure }}</h4>
                                            <h5 class="card-title text-center" style="color: {{ $treatment->brand->color }}">{{ is_null($treatment->package_id) ? '' : $treatment->package->package }}</h5>
                                            <h5 class="small text-center">{{ ($treatment->starting == 1) ?  'Price started at':'' }}</h5>
                                            
                                            @if ($treatment->discountType == 'porcent')
                                               <div class="row">
                                                   <div class="col-6">
                                                       <p class="text-danger">{{ $treatment->discount +0 }}% OFF</p>
                                                   </div>
                                                   <div class="col-6">
                                                       <p class="card-title text-center" style="text-decoration:line-through;">{{ is_null($treatment->price) ? '' : '$ '.$treatment->price }} USD </p>
                                                       <p class="card-title text-center text-danger">{{ is_null($treatment->price) ? '' : '$ '.$discountPrice }} USD </p>
                                                   </div>
                                               </div>
                                            @endif

                                            @if ($treatment->discountType == "money")
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p class="text-danger">{{ $treatment->discount +0}} DLLS OFF</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="card-title text-center" style="text-decoration:line-through;">{{ is_null($treatment->price) ? '' : '$ '.$treatment->price }} USD </p>
                                                        <p class="card-title text-center text-danger">{{ is_null($treatment->price) ? '' : '$ '.$discountPrice }} USD </p>
                                                    </div>
                                                </div>
                                            @endif


                                            @if (is_null($treatment->discountType))
                                                <h5 class="card-title text-center">{{ is_null($treatment->price) ? '' : '$ '.$treatment->price }} USD </h5>
                                            @endif
                                            <p class="card-text"></p>
                                            <span class="summer">
                                                <ul class="p-0">
                                                    @foreach ($treatment->contains as $include)
                                                        <li>{{ $include->include }}</li>
                                                    @endforeach
                                                </ul>
                                            </span>
                                        </div>
                                        <div class="card-fotter">
                                            <a href="{{ route('appIndex', ['id' => $treatment->id]) }}" class="btn btn-main btn-block btn-sm text-uppercase btn-apply"><i class="bi bi-clipboard-check me-3"></i> apply now</a>
                                        </div>
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
                <div class="row justify-content-center">
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
                <h2><strong>Coming soon</strong></h2>
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

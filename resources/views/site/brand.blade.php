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
        vamos

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

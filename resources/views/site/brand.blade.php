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

    test
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

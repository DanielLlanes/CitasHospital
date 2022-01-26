@extends('site.layouts.app')
@section('title')
 - Services Data
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Services Data</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Services Data</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="team" class="team">
        <div class="container">

            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Services<strong> Data</strong></h2>
                <p>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="{{ route('postServicesData') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Selected Service</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control form-control-sm" value="{{ $treatment->service->service }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Selected Procedure</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control form-control-sm" value="{{ $treatment->procedure->procedure }}">
                        </div>
                    </div>
                    @if (!is_null($treatment->package))
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Selected Package</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control form-control-sm" value="{{ $treatment->package->package}}">
                            </div>
                        </div>
                    @endif

                    @if($treatment->service->need_images)
                        <div class="col-12 my-md-5">
                            <h5 class="text-center">Upload Images</h5>
                        </div>
                        <div class="row">
                    @endif

                    <div class="error text-danger"></div>
                    

                    @php
                        for ($j = 0; $j < $treatment->service->qty_images; $j++){
                            echo '<div class="col-md-6 my-3">';
                            echo '<input type="file"'; 
                            echo 'class="dropify"';
                            echo 'order="' . ($j + 1) . '"';
                            echo 'data-height="200"';
                            for ($i = 0; $i < count($app->imageMany); $i++) {
                                if ($j+1 == $app->imageMany[$i]->order) {
                                    echo 'name="' . ($j+1) . '"';
                                    echo 'data-default-file="' . asset($app->imageMany[$i]->image) . '"';
                                    echo 'code="' . $app->imageMany[$i]->code . '"';
                                } 
                            }
                            echo '/>';
                            echo '</div>';
                        }
                    @endphp

                    <div class="mb-3 row">
                        <div class="col-6">
                            <a href="{{ route('appIndex', ['id' => $treatment->id]) }}" class="btn btn-main btn-sm mx-1">Back</a>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="button" id="next" class="btn btn-main btn-sm mx-1">Next</button>
                            <button type="button" class="btn btn-main btn-sm mx-1 cancel">Cancel</button>
                            <button type="reset" class="d-none reset">Reset</button>
                        </div>
                    </div>
                </form>
            <div class="col-md-4"></div>
        </div>
    </section>
    <!-- End Contact Section -->
</main>
@endsection
@section('styles')
    <link href="{{ asset('siteFiles/assets/vendor/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
@endsection
@section('scripts')
<script src="{{ asset('siteFiles/assets/vendor/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        var globalRouteupLoasImage = "{{ route('postServicesData') }}";
        var globalRouteNextStep = "{{ route('imagesNextStep') }}"
        var globalRouteDeleteFile = "{{ route('appImageDestroy') }}"
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        $(document).ready(function() {
            var drEvent = $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove':  'Remove',
                    'error':   'Ooops, something wrong happended.'
                },
                tpl: {
                    message:'<div class="dropify-message"><span class="file-icon" /> <p style="font-size: 16px">Drag and Drop a file or cleck here</p></div>',

                }
            });

            drEvent.on('dropify.beforeClear', function(event, element){
                var form_data = new FormData();
                var $this = $(this);
                form_data.append('order', $(this).attr('order'));
                form_data.append('code', $(this).attr('code'));
                $.ajax({
                    url: globalRouteDeleteFile,
                    method:"POST",
                    dataType:'JSON',
                    data:form_data,
                    contentType: false,
                    cache: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    beforeSend: function()
                    {

                    },
                    success:function(data)
                    {
                       if(data.success){
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        $this.attr('code', "")
                        //window.location.href = data.go;
                       } else {
                        $('.error').html(data.go)
                       }
                    },
                })
            });
        });

        $(document).on('change', ".dropify", function(e){
            var form_data = new FormData();
            var dropyfy = $(this).prop('files')[0];
            var $this = $(this);
            form_data.append('dropify', dropyfy);
            form_data.append('id', $(this).attr('id'));
            form_data.append('order', $(this).attr('order'));
            form_data.append('code', $(this).attr('code'));
            $.ajax({
                url: globalRouteupLoasImage,
                method:"POST",
                dataType:'JSON',
                data:form_data,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                beforeSend: function()
                {

                },
                success:function(data)
                {
                    //console.log(data);
                    Toast.fire({
                        icon: data.icon,
                        title: data.msg
                    })
                    $this.attr("code", data.data.code)
                },
            })
        })

        $(document).on('click', '#next', function(event) {
            event.preventDefault();
            var form_data = new FormData();
            var dropyfy = "holi";
            form_data.append('dropify', dropyfy);
            $.ajax({
                url: globalRouteNextStep,
                method:"POST",
                dataType:'JSON',
                data:form_data,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                beforeSend: function()
                {

                },
                success:function(data)
                {
                   if(data.success){
                    window.location.href = data.go;
                   } else {
                    $('.error').html(data.go)
                   }
                },
            })
        });
    </script>

@endsection

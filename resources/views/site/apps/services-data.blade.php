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

                    @for ($i = 0; $i < $treatment->service->qty_images; $i++)
                        <div class="col-md-6 my-3">
                            image {{ ($i + 1) }}
                            <input type="file" name="images[]" class="dropify" data-height="200" data-default-file="{{ asset($app->images[0]->local_image) ?? '' }}" />
                        </div>
                    @endfor

                    @if($treatment->service->need_images)
                        <div class="row">
                    @endif

                    <div class="mb-3 row">
                        <div class="col-6">
                            <a href="{{ route('appIndex', ['id' => $treatment->id]) }}" class="btn btn-main btn-sm mx-1">Back</a>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-main btn-sm mx-1">Next</button>
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
        var globalRouteobtenerEstados = "{{ route('getStates') }}";
        var globalRoutechekIfPatientExist = "{{ route('chekIfPatientExist') }}";
    </script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove':  'Remove',
                    'error':   'Ooops, something wrong happended.'
                },
                tpl: {
                    message:         '<div class="dropify-message"><span class="file-icon" /> <p style="font-size: 16px">Drag and Drop a file or cleck here</p></div>',

                }
            });
        });

        function clearForm() {
            $("input[name=treatmentBefore][value=0]").prop('checked', true);
            $("input[name=treatmentBefore]").attr('disabled', false);
            $("#name").val('').attr('disabled', false);
            $('#sex').find('option').not(':first').remove();
            $('#sex').val($("#target option:first").val());
            $("#sex").attr('disabled', false);
            $("#dob").val('').attr('disabled', false)
            $("#age").val('').attr('disabled', false)
            $("#phone").val('').attr('disabled', false)
            $("#mobile").val('').attr('disabled', false)
            $("#address").val('').attr('disabled', false)
            $('#country_id').find('option').not(':first').remove();
            $('#country_id').val($("#target option:first").val());
            $("#country_id").attr('disabled', false)
            $("#city").val('').attr('disabled', false)
            $("#zip").val('').attr('disabled', false)
            $("#ecn").val('').attr('disabled', false)
            $("#ecp").val('').attr('disabled', false)

            $('#state_id').find('option').not(':first').remove();
            $('#state_id').val($("#target option:first").val());
            $("#state_id").attr('disabled', false)
        }
    </script>

@endsection

@extends('site.layouts.app')
@section('title')
 - Reference Data
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Reference Data</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Reference Data</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->

    <section id="team" class="team">
        <div class="container">

            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Reference<strong> Data</strong></h2>
                <p>

                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 d-none d-md-block"></div>
            <div class="col-md-4 pt-5 p-md-0">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('postReferenceData') }}" method="POST" id="formHealthData">
                    {{ csrf_field() }}
                    <div class="mb-5 row">
                        <div class="col-3"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm text-center fw-bolder">How did you hear about us?</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Google</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_google" name="about_us_google">
                                <label class="form-check-label" for="flexCheckDefault">

                                </label>
                            </div>
                            @error('about_us_google')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Facebook</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_facebook" name="about_us_facebook">
                                <label class="form-check-label" for="about_us_facebook">

                                </label>
                            </div>
                            @error('about_us_facebook')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">YouTube/vimeo</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_youtube" name="about_us_youtube">
                                <label class="form-check-label" for="about_us_youtube">

                                </label>
                            </div>
                            @error('about_us_youtube')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Twitter</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_twiter" name="about_us_twiter">
                                <label class="form-check-label" for="about_us_twiter">

                                </label>
                            </div>
                            @error('about_us_twiter')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Web forums</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_forums" name="about_us_forums">
                                <label class="form-check-label" for="about_us_forums">

                                </label>
                            </div>
                            @error('about_us_forums')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Instagram</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_instagram" name="about_us_instagram">
                                <label class="form-check-label" for="about_us_instagram">

                                </label>
                            </div>
                            @error('about_us_instagram')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Radio</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_radio" name="about_us_radio">
                                <label class="form-check-label" for="about_us_radio">

                                </label>
                            </div>
                            @error('about_us_radio')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_email" name="about_us_email">
                                <label class="form-check-label" for="about_us_email">

                                </label>
                            </div>
                            @error('about_us_email')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Referred by a friend</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_frend" name="about_us_frend">
                                <label class="form-check-label" for="about_us_frend">

                                </label>
                            </div>
                            @error('about_us_frend')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row mt-1 about_us_frend" @if (old('about_us_frend') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Friends name</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="friend_name" name="friend_name" value="{{ $patient->friend_name ?? old('friend_name') }}" placeholder="">
                            @error('friend_name')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Other</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="about_us_other" name="about_us_other">
                                <label class="form-check-label" for="about_us_other">

                                </label>
                            </div>
                            @error('about_us_other')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row mt-1 about_us_other" @if (old('about_us_other') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Specify media</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="about_us_description_other" name="about_us_description_other" value="{{ $patient->about_us_description_other ?? old('about_us_description_other') }}" placeholder="">
                            @error('about_us_description_other')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-6">
                            <a href="{{ route('createServicesData') }}" class="btn btn-main btn-sm mx-1">Back</a>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-main btn-sm mx-1 send">Next</button>
                            <button type="button" class="btn btn-main btn-sm mx-1 cancel">Cancel</button>
                            <button type="reset" class="d-none reset">Reset</button>
                        </div>
                    </div>
                </form>
            <div class="col-md-4 d-none d-md-block"></div>
        </div>
    </section>
    <!-- End Contact Section -->
</main>
@endsection

@section('scripts')

    <script>

        $(document).on('change', "#about_us_frend", function () {
            if ($(this).is(":checked")) {
                $('.about_us_frend').show('fast')
            } else {
                $('.about_us_frend').hide('fast')
                $('#friend_name').val('')
            }
        });

        $(document).on('change', "#about_us_other", function () {
            if ($(this).is(":checked")) {
                $('.about_us_other').show('fast')
            } else {
                $('.about_us_other').hide('fast')
                $('#about_us_description_other').val('')
            }
        });

    </script>

@if (!empty($sessionData))
<script>
    $('#email').attr('disabled', true)
    $('#name').attr('disabled', true)

    var title = 'You have an open application registration';
    var text = 'You want to continue with the previous one?';
    var confirm = 'No, create a new one!';
    var cancel = 'Yes continue!';
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: confirm,
        cancelButtonText: cancel,
    }).then((result) => {
        if (result.value) {
            deleteSessionVarAndDeleteapp()
        } else if (result.dismiss) {
            // e.preventDefault()
            // e.stopPropagation();
        }
    })
    function deleteSessionVarAndDeleteapp()
    {
        event.preventDefault();
        var form_data = new FormData();
        form_data.append('hola', 'hola');
        $.ajax({
            url: globalRouteDeleteSessionVar,
            method:"POST",
            data:form_data,
            dataType:'JSON',
            contentType: false,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            success:function(response)
            {
                console.log(response)
                if (response == '1') {
                    location.reload();
                }
            }
        });
    }
    $(document).on('change', "input, select", function () {
        alert();
        //$(this).parents('.col-sm-9').find('.error').html('');
    });
</script>
@endif

@endsection

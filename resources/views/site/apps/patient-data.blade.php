@extends('site.layouts.app')
@section('title')
 - Patient Data
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Patient Data</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Patient Data</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->

    <section id="team" class="team">
        <div class="container">
            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Patient<strong> Data</strong></h2>
                <p>

                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">

                {{ Session::get('form_session') }}
                <form action="{{ route('createPatientData') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-2 row">
                        <div class="col-3"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm text-center">Have you received any treatment with us before?</p>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9 text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="treatmentBefore" id="treatmentBeforeYes" value="1" @if (old('treatmentBefore') == "1") checked @elseif(!empty($patient ?? '') && $patient->treatmentBefore == '1') checked @endif>
                                <label class="form-check-label" for="treatmentBeforeYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="treatmentBefore" id="treatmentBeforeNo" value="0" @if (old('treatmentBefore') == "0") checked @elseif(!empty($patient ?? '') && $patient->treatmentBefore == '0') checked @endif>
                                <label class="form-check-label" for="treatmentBeforeNo">No</label>
                            </div>
                            @error('treatmentBefore')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="email" name="email" value="{{ $patient->email ?? old('email') }}" placeholder="email@example.com">
                            @error('email')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $patient->name ?? old('name') }}" placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div id="data-hidde">
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Biological Sex</label>
                            <div class="col-sm-9">
                                <select name="sex" id="sex" class="form-control form-control-sm">
                                    <option value="" disabled selected>Select....</option>
                                    <option value="male" @if (old('sex') == "male") selected @elseif(!empty($patient) && $patient->sex == 'male') selected @endif>Male</option>
                                    <option value="female" @if (old('sex') == "female") selected @elseif(!empty($patient) && $patient->sex == 'famale') selected @endif>Female</option>

                                </select>
                                @error('sex')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Birth Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control form-control-sm" id="dob" name="dob" value="{{ $patient->dob ?? old('dob') }}" placeholder="Date of Birth">
                                @error('dob')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Age</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="age" name="age" value="{{ $patient->age ?? old('age') }}" placeholder="Age">
                                @error('age')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Phone</label>
                            <div class="col-sm-9">
                                <input type="phone" class="form-control form-control-sm" id="phone" name="phone" value="{{ $patient->phone ?? old('phone') }}" placeholder="phone">
                                @error('phone')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Mobile</label>
                            <div class="col-sm-9">
                                <input type="phone" class="form-control form-control-sm" id="mobile" name="mobile" value="{{ $patient->mobile ?? old('mobile') }}" placeholder="Mobile">
                                @error('mobile')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="address" name="address" value="{{ $patient->address ?? old('address') }}" placeholder="Address">
                                @error('address')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Country</label>
                            <div class="col-sm-9">
                                <select name="country_id" id="country_id" country="{{ $patient->country_id ?? old('country_id') }}" class="form-control form-control-sm">
                                    <option value="" disabled selected>Select....</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">State </label>
                            <div class="col-sm-9">
                                <select name="state_id" state="{{ $patient->state_id ?? old('state_id') }}" id="state_id" class="form-control form-control-sm">
                                    <option value="" disabled selected>Select....</option>
                                </select>
                                @error('state_id')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">City</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="city" name="city" value="{{ $patient->city ?? old('city') }}" placeholder="City">
                                @error('city')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Zip Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="zip" name="zip" value="{{ $patient->zip ?? old('zip') }}" placeholder="Zip">
                                @error('zip')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Emergency Contact Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="ecn" name="ecn" value="{{ $patient->ecn ?? old('ecn') }}" placeholder="Emergency Contact Name">
                                @error('ecn')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Emergency Contact Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="ecp" name="ecp" value="{{ $patient->ecp ?? old('ecp') }}" placeholder="Emergency Contact Phone">
                                @error('ecp')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Selected Service</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control form-control-sm" value="{{ $treatment->service->service }}">
                            </div>
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
                    <div class="mb-3 row">
                        <div class="col-6">
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

@section('scripts')
    <script>
        var globalRouteobtenerEstados = "{{ route('getStates') }}";
        var globalRoutechekIfPatientExist = "{{ route('chekIfPatientExist') }}";
    </script>

    <script>
        $(document).on('change', '#email', function () {
            var form_data = new FormData();
            form_data.append('email', $(this).val());
            $.ajax({
                url: globalRoutechekIfPatientExist,
                method:"POST",
                data:form_data,
                dataType:'JSON',
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
                    if (data.success) {
                        //$("input[name=treatmentBefore][value=1]").prop('checked', true);
                        //$("input[name=treatmentBefore]").attr('disabled', true);
                        $("#email").val(data.info.email);
                        $("#name").val(data.info.name);
                        $("#data-hidde").hide('fast');


                    } else {
                        //clearForm()
                        $("#data-hidde").show('fast');
                    }
                },
            })
        });
        $(document).on('change', '#country_id', function(event) {
            event.preventDefault();
            getStates()
        });
        $(document).on('change', "input, select", function () {
            $(this).parent().find('.invalid-feedback ').html('');
        });
        function getStates(state = null) {
            var form_data = new FormData();
            form_data.append('id', $( "#country_id option:selected" ).val());
            $.ajax({
                url: globalRouteobtenerEstados,
                method:"POST",
                data:form_data,
                dataType:'JSON',
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                beforeSend: function()
                {
                    $('#state_id').find('option').not(':first').remove();
                    $('#state_id').val($("#state_id option:first").val());
                },
                success:function(data)
                {
                    $.each(data, function (i, v) {
                        if (state !== null ) {
                            if (state == v.id) {
                                $('#state_id').append('<option selected value="'+v.id+'">'+v.name+'</option>');
                            }
                            $('#state_id').append('<option value="'+v.id+'">'+v.name+'</option>');
                        } else {
                            $('#state_id').append('<option value="'+v.id+'">'+v.name+'</option>');
                            $('#state_id').val($("#state_id option:eq(1)").val());
                        }

                    });
                },
                complete: function()
                {
                },
            })
        }
    </script>
    @if (old('country_id') || !empty($patient ?? ''))
    <script>
        var country_id = $( "#country_id" ).attr('country');
        $("#country_id option[value="+country_id+"]").attr("selected", true);
        getStates()
    </script>
    @endif
    @if (old('state_id') || !empty($patient ?? ''))
    <script>
        var state_id = $( "#state_id" ).attr('state');
        getStates(state_id)
    </script>
    @endif
@endsection

@extends('site.layouts.app')
@section('title')
 - General health Data
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>General health Data</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>General health Data</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->

    <section id="team" class="team">
        <div class="container">

            <div class="section-title mb-5" data-aos="fade-up">
                <h2>General health<strong> Data</strong></h2>
                <p>

                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 d-none d-md-block"></div>
            <div class="col-md-4 px-5 p-md-0">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('postGeneralHealthData') }}" method="POST" id="formHealthData">
                    {{ csrf_field() }}

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Do you smoke cigarettes</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="smoke" id="smoke_yes" value="1" @if (old('smoke') == "1") checked @elseif(!empty($patient ?? '') && $patient->smoke == '1') checked @endif>
                                <label class="form-check-label" for="smoke_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="smoke" id="smoke_no" value="0" @if (old('smoke') == "0") checked @elseif(!empty($patient ?? '') && $patient->smoke == '0') checked @endif>
                                <label class="form-check-label" for="smoke_no">No</label>
                            </div>
                            @error('smoke')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 smoke" @if (old('smoke') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Amount </span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control form-control-sm" id="smoke_cigars" name="smoke_cigars" value="{{ $patient->smoke_cigars ?? old('smoke_cigars') }}" placeholder="">
                            @error('smoke_cigars')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 smoke" @if (old('smoke') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Numer of years </span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control form-control-sm" id="smoke_years" name="smoke_years" value="{{ $patient->smoke_cigars ?? old('smoke_years') }}" placeholder="">
                            @error('smoke_years')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row smoke" @if (old('smoke') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Have you quit smoking?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stop_smoking" id="stop_smoking_yes" value="1" @if (old('stop_smoking') == "1") checked @elseif(!empty($patient ?? '') && $patient->stop_smoking == '1') checked @endif>
                                <label class="form-check-label" for="stop_smoking_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stop_smoking" id="stop_smoking_no" value="0" @if (old('stop_smoking') == "0") checked @elseif(!empty($patient ?? '') && $patient->stop_smoking == '0') checked @endif>
                                <label class="form-check-label" for="stop_smoking_no">No</label>
                            </div>
                            @error('stop_smoking')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 smoke_quit" @if (old('stop_smoking') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">How long </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="when_stop_smoking" name="when_stop_smoking" value="{{ $patient->when_stop_smoking ?? old('when_stop_smoking') }}" placeholder="">
                            @error('when_stop_smoking')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Do you drink alcohol?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alcohol" id="alcohol_yes" value="1" @if (old('alcohol') == "1") checked @elseif(!empty($patient ?? '') && $patient->alcohol == '1') checked @endif>
                                <label class="form-check-label" for="alcohol_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alcohol" id="alcohol_no" value="0" @if (old('alcohol') == "0") checked @elseif(!empty($patient ?? '') && $patient->alcohol == '0') checked @endif>
                                <label class="form-check-label" for="alcohol_no">No</label>
                            </div>
                            @error('alcohol')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Use recreational drugs?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="recreative_drugs" id="recreative_drugs_yes" value="1" @if (old('recreative_drugs') == "1") checked @elseif(!empty($patient ?? '') && $patient->recreative_drugs == '1') checked @endif>
                                <label class="form-check-label" for="recreative_drugs_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="recreative_drugs" id="recreative_drugs_no" value="0" @if (old('recreative_drugs') == "0") checked @elseif(!empty($patient ?? '') && $patient->recreative_drugs == '0') checked @endif>
                                <label class="form-check-label" for="recreative_drugs_no">No</label>
                            </div>
                            @error('recreative_drugs')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 recreative_drugs" @if (old('recreative_drugs') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Amount </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="total_recreative_drugs" name="total_recreative_drugs" value="{{ $patient->total_recreative_drugs ?? old('total_recreative_drugs') }}" placeholder="">
                            @error('total_recreative_drugs')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row recreative_drugs" @if (old('recreative_drugs') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Have you ever used intravenous drugs (or skin-popping)?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="intravenous_drugs" id="intravenous_drugs_yes" value="1" @if (old('intravenous_drugs') == "1") checked @elseif(!empty($patient ?? '') && $patient->intravenous_drugs == '1') checked @endif>
                                <label class="form-check-label" for="intravenous_drugs_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="intravenous_drugs" id="intravenous_drugs_no" value="0" @if (old('intravenous_drugs') == "0") checked @elseif(!empty($patient ?? '') && $patient->intravenous_drugs == '0') checked @endif>
                                <label class="form-check-label" for="intravenous_drugs_no">No</label>
                            </div>
                            @error('intravenous_drugs')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Are you easily fatigued?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tire" id="tire_yes" value="1" @if (old('tire') == "1") checked @elseif(!empty($patient ?? '') && $patient->tire == '1') checked @endif>
                                <label class="form-check-label" for="tire_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tire" id="tire_no" value="0" @if (old('tire') == "0") checked @elseif(!empty($patient ?? '') && $patient->tire == '0') checked @endif>
                                <label class="form-check-label" for="tire_no">No</label>
                            </div>
                            @error('tire')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Do you have shortness of breath?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="trouble_breathe" id="tire_yes" value="1" @if (old('trouble_breathe') == "1") checked @elseif(!empty($patient ?? '') && $patient->trouble_breathe == '1') checked @endif>
                                <label class="form-check-label" for="tire_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="trouble_breathe" id="tire_no" value="0" @if (old('trouble_breathe') == "0") checked @elseif(!empty($patient ?? '') && $patient->trouble_breathe == '0') checked @endif>
                                <label class="form-check-label" for="tire_no">No</label>
                            </div>
                            @error('trouble_breathe')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Do you have asthma?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="asthma" id="tire_yes" value="1" @if (old('asthma') == "1") checked @elseif(!empty($patient ?? '') && $patient->asthma == '1') checked @endif>
                                <label class="form-check-label" for="tire_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="asthma" id="tire_no" value="0" @if (old('asthma') == "0") checked @elseif(!empty($patient ?? '') && $patient->asthma == '0') checked @endif>
                                <label class="form-check-label" for="tire_no">No</label>
                            </div>
                            @error('asthma')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Do you use a B-PAP or C-PAP while you sleep?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bipap_cpap" id="tire_yes" value="1" @if (old('bipap_cpap') == "1") checked @elseif(!empty($patient ?? '') && $patient->bipap_cpap == '1') checked @endif>
                                <label class="form-check-label" for="tire_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bipap_cpap" id="tire_no" value="0" @if (old('bipap_cpap') == "0") checked @elseif(!empty($patient ?? '') && $patient->bipap_cpap == '0') checked @endif>
                                <label class="form-check-label" for="tire_no">No</label>
                            </div>
                            @error('asthma')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Do you exercise?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exercise" id="if_take_medication_yes" value="1" @if (old('exercise') == "1") checked @elseif(!empty($patient ?? '') && $patient->exercise == '1') checked @endif>
                                <label class="form-check-label" for="if_take_medication_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exercise" id="if_take_medication_no" value="0" @if (old('exercise') == "0") checked @elseif(!empty($patient ?? '') && $patient->exercise == '0') checked @endif>
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('exercise')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12" id="medication_table" style="display: none">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="font-weight: 600; font-size: .9rem; display: none">Order</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Type</th>
                                    <th style="font-weight: 600; font-size: .9rem;">How long</th>
                                    <th style="font-weight: 600; font-size: .9rem;">How frecuency</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Hours per day</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty(old('exerciseCadena')))
                                    @for ($i = 0; $i < count(old('exerciseCadena')); $i++)
                                        <tr>
                                            <th>
                                                <input type="text" name="exercise_type[]" class="form-control form-control-sm" value="{{ old('exerciseCadena')[$i]->exercise_type }}">
                                                @error('exercise_type.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <td>
                                                <input type="text" name="exercise_how_long[]" class="form-control form-control-sm" value="{{ old('exerciseCadena')[$i]->exercise_how_long }}">
                                                @error('exercise_how_long.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="exercise_how_frecuent[]" class="form-control form-control-sm" value="{{ old('exerciseCadena')[$i]->exercise_how_frecuent }}">
                                                @error('exercise_how_frecuent.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="exercise_hours[]" class="form-control form-control-sm" value="{{ old('exerciseCadena')[$i]->exercise_hours }}">
                                                @error('exercise_hours.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm btn-block deleteSurgey" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-second text-white mb-3" id="exerciceTableAdd">Add exercice</button>
                        </div>
                    </div>

                    <div class="mb-3 row mt-5">
                        <div class="col-6">
                                <a href="{{ route('createHealthData') }}" class="btn btn-main btn-sm mx-1">Back</a>
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

        $(document).on('click', '.deleteSurgey', function(event) {
            $(this).parents('tr').remove()

            if ($("#medication_table tbody tr").length < 1) {
                addExerciseFields()
            }

        });

        $(document).on('click', '#exerciceTableAdd',function () {
            $('.formError').html('')
            addExerciseFields()
        });

        $(document).on('change', 'input[type=radio][name=smoke]',  function (e) {

            if ($("input[type=radio][name=smoke]:checked").val() == '1') {
                $('.smoke').show('fast')

            } else {
                $('.smoke').hide('fast')
                $('#smoke_cigars').val('')
                $('#smoke_years').val('')
                $('.smoke_quit').hide('fast')
                $('#when_stop_smoking').val('');

            }
        });

        $(document).on('change', 'input[type=radio][name=exercise]',  function (e) {
            if ($("input[type=radio][name=exercise]:checked").val() == '1') {
                $('#medication_table').show('fast')
                addExerciseFields()
            } else {
                $('#medication_table').hide('fast')
                $('#when_stop_smoking').val('');
                $('#medication_table').find('tbody').html('');
            }
        });

        $(document).on('change', 'input[type=radio][name=stop_smoking]',  function (e) {
            if ($("input[type=radio][name=stop_smoking]:checked").val() == '1') {
                $('.smoke_quit').show('fast')
            } else {
                $('.smoke_quit').hide('fast')
                $('#when_stop_smoking').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=recreative_drugs]',  function (e) {
            if ($("input[type=radio][name=recreative_drugs]:checked").val() == '1') {
                $('.recreative_drugs').show('fast')
            } else {
                $('.recreative_drugs').hide('fast')
                $('#total_recreative_drugs').val('');
                $("input[name=intravenous_drugs][value=0]").prop('checked', true);
            }
        });

        $(document).on('click', ".cancel", function(e) {
            e.preventDefault
            $('.reset').click();
            clearForm()
        })

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


        function addExerciseFields() {
            var medicationField = '';
            medicationField += '<tr>'
            medicationField += '<th>'
            medicationField += '<input type="text" name="exercise_type[]" class="form-control form-control-sm">'
            medicationField += '</th>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="exercise_how_long[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="exercise_how_frecuent[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="exercise_hours[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td class="text-center">'
            medicationField += '<button class="btn btn-danger btn-sm btn-block deleteSurgey" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>'
            medicationField += '</td>'
            medicationField += '</tr>'
            $('#medication_table tbody').append(medicationField)
        }
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
@if (!empty(old('exerciseCadena')))
<script>
    $("#medication_table").show('fast');
</script>
@endif

@endsection

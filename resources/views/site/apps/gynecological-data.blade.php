@extends('site.layouts.app')
@section('title')
 - Gynecological Data
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Gynecological Data</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Gynecological Data</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->

    <section id="team" class="team">
        <div class="container">

            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Gynecological<strong> Data</strong></h2>
                <p>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 d-none d-md-block"></div>
            <div class="col-md-6 px-5 p-md-0">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('postGynecologicalData') }}" method="POST" id="formHealthData">
                    {{ csrf_field() }}


                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Date of last menstrual period</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="last_menstrual_period" name="last_menstrual_period" value="{{ $patient->last_menstrual_period ?? old('last_menstrual_period') }}" placeholder="">
                            @error('last_menstrual_period')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Bleeding was?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bleeding_whas" id="bleeding_whasyes" value="normal" @if (old('bleeding_whas') == "normal") checked @elseif(!empty($patient ?? '') && $patient->bleeding_whas == 'normal') checked @endif>
                                <label class="form-check-label" for="bleeding_whas_normal">Normal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bleeding_whas" id="bleeding_whas_no" value="light" @if (old('bleeding_whas') == "light") checked @elseif(!empty($patient ?? '') && $patient->bleeding_whas == 'light') checked @endif>
                                <label class="form-check-label" for="bleeding_whas_light">Light</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bleeding_whas" id="bleeding_whas_yes" value="heavy" @if (old('bleeding_whas') == "heavy") checked @elseif(!empty($patient ?? '') && $patient->bleeding_whas == 'heavy') checked @endif>
                                <label class="form-check-label" for="bleeding_whas_heavy">Heavy</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="bleeding_whas" id="bleeding_whas_no" value="irregular" @if (old('bleeding_whas') == "irregular") checked @elseif(!empty($patient ?? '') && $patient->bleeding_whas == 'irregular') checked @endif>
                                <label class="form-check-label" for="bleeding_whas_irregular">Irregular</label>
                            </div>
                            @error('bleeding_whas')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Have you been pregnant?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="have_you_been_pregnant" id="if_take_medication_yes" value="1" @if (old('have_you_been_pregnant') == "1") checked @elseif(!empty($patient ?? '') && $patient->have_you_been_pregnant == '1') checked @endif>
                                <label class="form-check-label" for="if_take_medication_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="have_you_been_pregnant" id="if_take_medication_no" value="0" @if (old('have_you_been_pregnant') == "0") checked @elseif(!empty($patient ?? '') && $patient->have_you_been_pregnant == '0') checked @endif>
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('have_you_been_pregnant')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 have_you_been_pregnant" @if (old('have_you_been_pregnant') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">How many times?</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="how_many_times" name="how_many_times" value="{{ $patient->how_many_times ?? old('how_many_times') }}" placeholder="">
                            @error('how_many_times')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3 have_you_been_pregnant" @if (old('have_you_been_pregnant') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">C-section</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="c_section" name="c_section" value="{{ $patient->c_section ?? old('c_section') }}" placeholder="">
                            @error('c_section')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Do you use any type of birth control?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="birth_control" id="if_take_medication_yes" value="1" @if (old('birth_control') == "1") checked @elseif(!empty($patient ?? '') && $patient->birth_control == '1') checked @endif>
                                <label class="form-check-label" for="if_take_medication_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="birth_control" id="if_take_medication_no" value="0" @if (old('birth_control') == "0") checked @elseif(!empty($patient ?? '') && $patient->birth_control == '0') checked @endif>
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('birth_control')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    =
                    > {{ old('birthCadena') }}
                    <div class="col-12" id="birth_control_table" style="display: none">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="font-weight: 600; font-size: .9rem; display: none">Order</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Type</th>
                                    <th style="font-weight: 600; font-size: .9rem;">How long have you used this birth control?</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty(old('birthCadena')))
                                    @for ($i = 0; $i < count(old('birthCadena')); $i++)
                                        <tr>
                                            <th>
                                                <input type="text" name="birthControl_type[]" class="form-control form-control-sm" value="{{ old('birthCadena')[$i]->birthControl_type }}">
                                                @error('birthControl_type.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <td>
                                                <input type="text" name="birthControl_how_long[]" class="form-control form-control-sm" value="{{ old('birthCadena')[$i]->birthControl_how_long }}">
                                                @error('birthControl_how_long'.$i)
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
                            <button type="button" class="btn btn-second text-white mb-3" id="birthControlTableAdd">Add birth control</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Hormones</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="use_hormones" id="if_take_medication_yes" value="1" @if (old('use_hormones') == "1") checked @elseif(!empty($patient ?? '') && $patient->use_hormones == '1') checked @endif>
                                <label class="form-check-label" for="if_take_medication_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="use_hormones" id="if_take_medication_no" value="0" @if (old('use_hormones') == "0") checked @elseif(!empty($patient ?? '') && $patient->use_hormones == '0') checked @endif>
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('use_hormones')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12" id="hormones_table" style="display: none">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="font-weight: 600; font-size: .9rem; display: none">Order</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Type</th>
                                    <th style="font-weight: 600; font-size: .9rem;">How long have you used this birth control?</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty(old('hormoneCadena')))
                                    @for ($i = 0; $i < count(old('hormoneCadena')); $i++)
                                        <tr>
                                            <th>
                                                <input type="text" name="hormone_type[]" class="form-control form-control-sm" value="{{ old('hormoneCadena')[$i]->hormone_type }}">
                                                @error('hormone_type.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <td>
                                                <input type="text" name="hormone_how_long[]" class="form-control form-control-sm" value="{{ old('hormoneCadena')[$i]->hormone_how_long }}">
                                                @error('hormone_how_long.'.$i)
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
                            <button type="button" class="btn btn-second text-white mb-3" id="hormoneTableAdd">Add hormone</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Are you pregnant? or is there a possibility of you being pregnant?</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_or_can_be_pregman" id="bleeding_whasyes" value="1" @if (old('is_or_can_be_pregman') == "1") checked @elseif(!empty($patient ?? '') && $patient->is_or_can_be_pregman == '1') checked @endif>
                                <label class="form-check-label" for="bleeding_whas_normal">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="is_or_can_be_pregman" id="bleeding_whas_no" value="0" @if (old('is_or_can_be_pregman') == "0") checked @elseif(!empty($patient ?? '') && $patient->is_or_can_be_pregman == '0') checked @endif>
                                <label class="form-check-label" for="bleeding_whas_light">No</label>
                            </div>
                            @error('is_or_can_be_pregman')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
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
            <div class="col-md-3 d-none d-md-block"></div>
        </div>
    </section>
    <!-- End Contact Section -->
</main>
@endsection

@section('scripts')

    <script>

        $(document).on('change', 'input[type=radio][name=have_you_been_pregnant]',  function (e) {

            if ($("input[type=radio][name=have_you_been_pregnant]:checked").val() == '1') {
                $('.have_you_been_pregnant').show('fast')
                addHormoneFields()
            } else {
                $('.have_you_been_pregnant').hide('fast')
                $('#how_many_times').val('')
                $('#c_section').val('')
            }
        });

        $(document).on('click', '.deleteHormone', function(event) {
            $(this).parents('tr').remove()

            if ($("#hormones_table tbody tr").length < 1) {
                addHormoneFields()
            }

        });

        $(document).on('click', '.deletebirthControl', function(event) {
            $(this).parents('tr').remove()

            if ($("#birth_control_table tbody tr").length < 1) {
                addbirthControlFields()
            }

        });

        $(document).on('click', '#hormoneTableAdd',function () {
            $('.formError').html('')
            addHormoneFields()
        });

        $(document).on('click', '#birthControlTableAdd',function () {
            $('.formError').html('')
            addbirthControlFields()
        });

        $(document).on('change', 'input[type=radio][name=use_hormones]',  function (e) {

            if ($("input[type=radio][name=use_hormones]:checked").val() == '1') {
                $('#hormones_table').show('fast')
                addHormoneFields()
            } else {
                $('#hormones_table').hide('fast')
                $('#hormones_table').find('tbody').html('');
            }
        });

        $(document).on('change', 'input[type=radio][name=birth_control]',  function (e) {

            if ($("input[type=radio][name=birth_control]:checked").val() == '1') {
                $('#birth_control_table').show('fast')
                addbirthControlFields()
            } else {
                $('#birth_control_table').hide('fast')
                $('#birth_control_table').find('tbody').html('');
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

        function addHormoneFields() {
            var medicationField = '';
            medicationField += '<tr>'
            medicationField += '<th>'
            medicationField += '<input type="text" name="hormone_type[]" class="form-control form-control-sm">'
            medicationField += '</th>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="hormone_how_long[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<td class="text-center">'
            medicationField += '<button class="btn btn-danger btn-sm btn-block deleteHormone" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>'
            medicationField += '</td>'
            medicationField += '</tr>'
            $('#hormones_table tbody').append(medicationField)
        }


        function addbirthControlFields() {
            var medicationField = '';
            medicationField += '<tr>'
            medicationField += '<th>'
            medicationField += '<input type="text" name="birthControl_type[]" class="form-control form-control-sm">'
            medicationField += '</th>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="birthControl_how_long[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td class="text-center">'
            medicationField += '<button class="btn btn-danger btn-sm btn-block deletebirthControl" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>'
            medicationField += '</td>'
            medicationField += '</tr>'
            $('#birth_control_table tbody').append(medicationField)
        }
    </script>

@if (old("exerciseCadena") && count('exerciseCadena'))
<script>
    $("#birth_control_table").show('fast');
</script>
@endif
@if (old("exerciseCadena") && count('exerciseCadena'))
<script>
    $("#hormones_table").show('fast');
</script>
@endif
@endsection

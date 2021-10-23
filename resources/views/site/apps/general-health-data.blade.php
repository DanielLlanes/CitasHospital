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
                            <input type="text" class="form-control form-control-sm" id="smoke_cigars" name="smoke_cigars" value="{{ $patient->smoke_cigars ?? old('smoke_cigars') }}" placeholder="">
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
                    <div class="mb-3 row mt-1 alcohol" @if (old('alcohol') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Amount </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="volumen_alcohol" name="volumen_alcohol" value="{{ $patient->volumen_alcohol ?? old('volumen_alcohol') }}" placeholder="">
                            @error('volumen_alcohol')
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

                    <div class="mb-3 row mt-1 intravenous_drugs" @if (old('recreative_drugs') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Describe intravenous drugs </span></label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control form-control-sm" id="description_intravenous_drugs" name="description_intravenous_drugs" value="{{ $patient->description_intravenous_drugs ?? old('description_intravenous_drugs') }}" placeholder=""></textarea>
                            @error('description_intravenous_drugs')
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
                                <input class="form-check-input" type="radio" name="fatigue" id="tire_yes" value="1" @if (old('fatigue') == "1") checked @elseif(!empty($patient ?? '') && $patient->fatigue == '1') checked @endif>
                                <label class="form-check-label" for="tire_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fatigue" id="tire_no" value="0" @if (old('fatigue') == "0") checked @elseif(!empty($patient ?? '') && $patient->fatigue == '0') checked @endif>
                                <label class="form-check-label" for="tire_no">No</label>
                            </div>
                            @error('fatigue')
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
                                {{ old('exerciseCadena') }}
                                @if (!empty(old('exerciseCadena')))
                                1
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

                    @if ($treatment->service_id == 3)
                        <div class="mb-3 row mt-1">
                            <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Hours you sleep at night?</span></label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-sm" id="hours_you_sleep_at_night" name="hours_you_sleep_at_night" value="{{ $patient->hours_you_sleep_at_night ?? old('hours_you_sleep_at_night') }}" placeholder="">
                                @error('hours_you_sleep_at_night')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong class="error">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you take sleeping pills?</label>
                            <div class="col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_take_sleeping_pills" id="do_you_take_sleeping_pills_yes" value="1" @if (old('do_you_take_sleeping_pills') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_take_sleeping_pills == '1') checked @endif>
                                    <label class="form-check-label" for="do_you_take_sleeping_pills_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_take_sleeping_pills" id="do_you_take_sleeping_pills_no" value="0" @if (old('do_you_take_sleeping_pills') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_take_sleeping_pills == '0') checked @endif>
                                    <label class="form-check-label" for="do_you_take_sleeping_pills_no">No</label>
                                </div>
                                @error('do_you_take_sleeping_pills')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong class="error">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you suffer from anxiety or depression?</label>
                            <div class="col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_suffer_from_anxiety_or_depression" id="do_you_suffer_from_anxiety_or_depression_yes" value="1" @if (old('do_you_suffer_from_anxiety_or_depression') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_suffer_from_anxiety_or_depression == '1') checked @endif>
                                    <label class="form-check-label" for="do_you_suffer_from_anxiety_or_depression_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_suffer_from_anxiety_or_depression" id="do_you_suffer_from_anxiety_or_depression_no" value="0" @if (old('do_you_suffer_from_anxiety_or_depression') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_suffer_from_anxiety_or_depression == '0') checked @endif>
                                    <label class="form-check-label" for="do_you_suffer_from_anxiety_or_depression_no">No</label>
                                </div>
                                @error('do_you_suffer_from_anxiety_or_depression')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong class="error">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you take pills for anxiety or depression?</label>
                            <div class="col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_take_pills_for_anxiety_or_depression" id="do_you_take_pills_for_anxiety_or_depression_yes" value="1" @if (old('do_you_take_pills_for_anxiety_or_depression') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_take_pills_for_anxiety_or_depression == '1') checked @endif>
                                    <label class="form-check-label" for="do_you_take_pills_for_anxiety_or_depression_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_take_pills_for_anxiety_or_depression" id="do_you_take_pills_for_anxiety_or_depression_no" value="0" @if (old('do_you_take_pills_for_anxiety_or_depression') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_take_pills_for_anxiety_or_depression == '0') checked @endif>
                                    <label class="form-check-label" for="do_you_take_pills_for_anxiety_or_depression_no">No</label>
                                </div>
                                @error('do_you_take_pills_for_anxiety_or_depression')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong class="error">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you feel under stress?</label>
                            <div class="col-sm-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_feel_under_stress" id="do_you_take_pills_for_anxiety_or_depression_yes" value="1" @if (old('do_you_feel_under_stress') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_feel_under_stress == '1') checked @endif>
                                    <label class="form-check-label" for="do_you_take_pills_for_anxiety_or_depression_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="do_you_feel_under_stress" id="do_you_take_pills_for_anxiety_or_depression_no" value="0" @if (old('do_you_feel_under_stress') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_feel_under_stress == '0') checked @endif>
                                    <label class="form-check-label" for="do_you_take_pills_for_anxiety_or_depression_no">No</label>
                                </div>
                                @error('do_you_feel_under_stress')
                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong class="error">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if ($patient->sex == 'male')
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you have erections at the morning?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_have_erections_at_the_morning" id="do_you_have_erections_at_the_morning_yes" value="1" @if (old('do_you_have_erections_at_the_morning') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="do_you_have_erections_at_the_morning_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_have_erections_at_the_morning" id="do_you_have_erections_at_the_morning_no" value="0" @if (old('do_you_have_erections_at_the_morning') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="do_you_have_erections_at_the_morning_no">No</label>
                                    </div>
                                    @error('do_you_have_erections_at_the_morning')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_have_erections_at_the_morning" @if (old('do_you_have_erections_at_the_morning') == 1) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">How many per week?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="how_many_per_week" name="how_many_per_week" value="{{ $patient->how_many_per_week ?? old('how_many_per_week') }}" placeholder="">
                                    @error('how_many_per_week')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you have problems getting erections?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_have_problems_getting_erections" id="do_you_have_problems_getting_erections_yes" value="1" @if (old('do_you_have_problems_getting_erections') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="do_you_have_problems_getting_erections_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_have_problems_getting_erections" id="do_you_have_problems_getting_erections_no" value="0" @if (old('do_you_have_problems_getting_erections') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="do_you_have_problems_getting_erections_no">No</label>
                                    </div>
                                    @error('do_you_have_problems_getting_erections')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_have_problems_getting_erections"  @if (old('do_you_have_problems_getting_erections') == 1) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Since when?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="since_when" name="since_when" value="{{ $patient->since_when ?? old('since_when') }}" placeholder="">
                                    @error('since_when')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_have_problems_getting_erections"  @if (old('do_you_have_problems_getting_erections') == 1) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Describe</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control form-control-sm" id="describe_your_erection_problem" name="describe_your_erection_problem" value="{{ $patient->describe_your_erection_problem ?? old('describe_your_erection_problem') }}" placeholder=""></textarea>
                                    @error('describe_your_erection_problem')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you have problems maintaining an erection?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_have_problems_maintaining_an_erection" id="do_you_have_problems_maintaining_an_erection_yes" value="1" @if (old('do_you_have_problems_maintaining_an_erection') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="do_you_have_problems_maintaining_an_erection_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_have_problems_maintaining_an_erection" id="do_you_have_problems_maintaining_an_erection_no" value="0" @if (old('do_you_have_problems_maintaining_an_erection') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="do_you_have_problems_maintaining_an_erection_no">No</label>
                                    </div>
                                    @error('do_you_have_problems_maintaining_an_erection')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you take any natural remedy for Erectile dysfunction?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_take_any_natural_remedy_for_erectile_dysfunction" id="do_you_have_problems_maintaining_an_erection_yes" value="1" @if (old('do_you_take_any_natural_remedy_for_erectile_dysfunction') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="do_you_have_problems_maintaining_an_erection_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_take_any_natural_remedy_for_erectile_dysfunction" id="do_you_have_problems_maintaining_an_erection_no" value="0" @if (old('do_you_take_any_natural_remedy_for_erectile_dysfunction') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="do_you_have_problems_maintaining_an_erection_no">No</label>
                                    </div>
                                    @error('do_you_take_any_natural_remedy_for_erectile_dysfunction')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_take_any_natural_remedy_for_erectile_dysfunction" @if (old('do_you_take_any_natural_remedy_for_erectile_dysfunction')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">What kind?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="what_kind" name="what_kind" value="{{ $patient->what_kind ?? old('what_kind') }}" placeholder="">
                                    @error('what_kind')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_take_any_natural_remedy_for_erectile_dysfunction" @if (old('do_you_take_any_natural_remedy_for_erectile_dysfunction')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">How did it work?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="how_did_it_work_natural_remedy" name="how_did_it_work_natural_remedy" value="{{ $patient->how_did_it_work_natural_remedy ?? old('how_did_it_work_natural_remedy') }}" placeholder="">
                                    @error('how_did_it_work_natural_remedy')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_take_any_natural_remedy_for_erectile_dysfunction" @if (old('do_you_take_any_natural_remedy_for_erectile_dysfunction')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Where did you get them?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="where_did_you_get_them" name="where_did_you_get_them" value="{{ $patient->where_did_you_get_them ?? old('where_did_you_get_them') }}" placeholder="">
                                    @error('where_did_you_get_them')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Has medication been injected for dysfunction erectile?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="has_medication_been_injected_for_dysfunction_erectile" id="has_medication_been_injected_for_dysfunction_erectile_yes" value="1" @if (old('has_medication_been_injected_for_dysfunction_erectile') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="has_medication_been_injected_for_dysfunction_erectile_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="has_medication_been_injected_for_dysfunction_erectile" id="has_medication_been_injected_for_dysfunction_erectile_no" value="0" @if (old('has_medication_been_injected_for_dysfunction_erectile') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="has_medication_been_injected_for_dysfunction_erectile_no">No</label>
                                    </div>
                                    @error('has_medication_been_injected_for_dysfunction_erectile')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 has_medication_been_injected_for_dysfunction_erectile" @if (old('has_medication_been_injected_for_dysfunction_erectile')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">How many times?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="how_many_times_have_injected" name="how_many_times_have_injected" value="{{ $patient->how_many_times_have_injected ?? old('how_many_times_have_injected') }}" placeholder="">
                                    @error('how_many_times_have_injected')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 has_medication_been_injected_for_dysfunction_erectile" @if (old('has_medication_been_injected_for_dysfunction_erectile')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">How did it work?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="how_did_it_work" name="how_did_it_work" value="{{ $patient->how_did_it_work ?? old('how_did_it_work') }}" placeholder="">
                                    @error('how_did_it_work')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Have you had an erection longer than 6 hours?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="have_you_had_an_erection_longer_than_six_hours" id="have_you_had_an_erection_longer_than_six_hours_yes" value="1" @if (old('have_you_had_an_erection_longer_than_six_hours') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="have_you_had_an_erection_longer_than_six_hours_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="have_you_had_an_erection_longer_than_six_hours" id="have_you_had_an_erection_longer_than_six_hours_no" value="0" @if (old('have_you_had_an_erection_longer_than_six_hours') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="have_you_had_an_erection_longer_than_six_hours_no">No</label>
                                    </div>
                                    @error('have_you_had_an_erection_longer_than_six_hours')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 have_you_had_an_erection_longer_than_six_hours" @if (old('have_you_had_an_erection_longer_than_six_hours')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">When?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="when_you_had_a_six_hours_erection" name="when_you_had_a_six_hours_erection" value="{{ $patient->when_you_had_a_six_hours_erection ?? old('when_you_had_a_six_hours_erection') }}" placeholder="">
                                    @error('when_you_had_a_six_hours_erection')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 have_you_had_an_erection_longer_than_six_hours" @if (old('have_you_had_an_erection_longer_than_six_hours')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">How was it resolved?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="how_was_it_resolved" name="how_was_it_resolved" value="{{ $patient->how_was_it_resolved ?? old('how_was_it_resolved') }}" placeholder="">
                                    @error('how_was_it_resolved')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 have_you_had_an_erection_longer_than_six_hours" @if (old('have_you_had_an_erection_longer_than_six_hours')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Did you get medical attention?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="did_you_get_medical_attention" name="did_you_get_medical_attention" value="{{ $patient->did_you_get_medical_attention ?? old('did_you_get_medical_attention') }}" placeholder="">
                                    @error('did_you_get_medical_attention')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Do you suffer from penile curvature?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_suffer_from_penile_curvature" id="do_you_suffer_from_penile_curvature_yes" value="1" @if (old('do_you_suffer_from_penile_curvature') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="do_you_suffer_from_penile_curvature_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="do_you_suffer_from_penile_curvature" id="do_you_suffer_from_penile_curvature_no" value="0" @if (old('do_you_suffer_from_penile_curvature') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="do_you_suffer_from_penile_curvature_no">No</label>
                                    </div>
                                    @error('do_you_suffer_from_penile_curvature')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_suffer_from_penile_curvature" @if (old('do_you_suffer_from_penile_curvature')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">How intense?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="how_intense" name="how_intense" value="{{ $patient->how_intense ?? old('how_intense') }}" placeholder="">
                                    @error('how_intense')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_suffer_from_penile_curvature" @if (old('do_you_suffer_from_penile_curvature')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Which direction?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="which_direction" name="which_direction" value="{{ $patient->which_direction ?? old('which_direction') }}" placeholder="">
                                    @error('which_direction')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_suffer_from_penile_curvature" @if (old('do_you_suffer_from_penile_curvature')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Does it hurt?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="does_it_hurt" name="does_it_hurt" value="{{ $patient->does_it_hurt ?? old('does_it_hurt') }}" placeholder="">
                                    @error('does_it_hurt')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-1 do_you_suffer_from_penile_curvature" @if (old('do_you_suffer_from_penile_curvature')) @else style="display: none" @endif>
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Does it prevent intercourse?</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="does_it_prevent_intercourse" name="does_it_prevent_intercourse" value="{{ $patient->does_it_prevent_intercourse ?? old('does_it_prevent_intercourse') }}" placeholder="">
                                    @error('does_it_prevent_intercourse')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Has PRP been injected for erectile dysfunction?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="has_prp_been_injected_for_erectile_dysfunction" id="has_prp_been_injected_for_erectile_dysfunction_yes" value="1" @if (old('has_prp_been_injected_for_erectile_dysfunction') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="has_prp_been_injected_for_erectile_dysfunction_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="has_prp_been_injected_for_erectile_dysfunction" id="has_prp_been_injected_for_erectile_dysfunction_no" value="0" @if (old('has_prp_been_injected_for_erectile_dysfunction') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="has_prp_been_injected_for_erectile_dysfunction_no">No</label>
                                    </div>
                                    @error('has_prp_been_injected_for_erectile_dysfunction')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Have you received stem cell treatment for erectile dysfunction</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="have_you_received_stem_cell_treatment_for_erectile_dysfunction" id="have_you_received_stem_cell_treatment_for_erectile_dysfunction_yes" value="1" @if (old('have_you_received_stem_cell_treatment_for_erectile_dysfunction') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="have_you_received_stem_cell_treatment_for_erectile_dysfunction_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="have_you_received_stem_cell_treatment_for_erectile_dysfunction" id="have_you_received_stem_cell_treatment_for_erectile_dysfunction_no" value="0" @if (old('have_you_received_stem_cell_treatment_for_erectile_dysfunction') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="have_you_received_stem_cell_treatment_for_erectile_dysfunction_no">No</label>
                                    </div>
                                    @error('have_you_received_stem_cell_treatment_for_erectile_dysfunction')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-6 col-form-label col-form-label-sm">Have you received vascular regeneration therapy with low intensity wave therapy for erectile dysfunction?</label>
                                <div class="col-sm-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="hyrvrntwliwtfed" id="hyrvrntwliwtfed_yes" value="1" @if (old('hyrvrntwliwtfed') == "1") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '1') checked @endif>
                                        <label class="form-check-label" for="hyrvrntwliwtfed_yes">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="hyrvrntwliwtfed" id="hyrvrntwliwtfed_no" value="0" @if (old('hyrvrntwliwtfed') == "0") checked @elseif(!empty($patient ?? '') && $patient->do_you_have_erections_in_the_moring == '0') checked @endif>
                                        <label class="form-check-label" for="hyrvrntwliwtfed_no">No</label>
                                    </div>
                                    @error('hyrvrntwliwtfed')
                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong class="error">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    @endif

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
        var amount = $('#smoke_cigars').val();
        var present=0;

        $(document).on('keypress', '#smoke_cigars', function (evt) {
            var code = (evt.which) ? evt.which : evt.keyCode;
            var amount = $('#smoke_cigars').val();
            if ((amount.indexOf('.') >= 0)) {
                console.log('ke', amount);
            } else {
                console.log('no');
            }
        });
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
                $('input[name=stop_smoking]').prop('checked', false);
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

        $(document).on('change', 'input[type=radio][name=do_you_have_erections_at_the_morning]', function(){
            if ($("input[type=radio][name=do_you_have_erections_at_the_morning]:checked").val() == '1') {
                $('.do_you_have_erections_at_the_morning').show('fast')
            } else {
                $('.do_you_have_erections_at_the_morning').hide('fast')
                $('#how_many_per_week').val('');
            }
        })
        $(document).on('change', 'input[type=radio][name=do_you_have_problems_getting_erections]', function(){
            if ($("input[type=radio][name=do_you_have_problems_getting_erections]:checked").val() == '1') {
                $('.do_you_have_problems_getting_erections').show('fast')
            } else {
                $('.do_you_have_problems_getting_erections').hide('fast')
                $('#since_when').val('');
                $('#describe_your_erection_problem').val('');
                $('#describe_your_erection_problem').val('');
            }
        })

        $(document).on('change', 'input[type=radio][name=do_you_take_any_natural_remedy_for_erectile_dysfunction]', function(){
            if ($("input[type=radio][name=do_you_take_any_natural_remedy_for_erectile_dysfunction]:checked").val() == '1') {
                $('.do_you_take_any_natural_remedy_for_erectile_dysfunction').show('fast')
            } else {
                $('.do_you_take_any_natural_remedy_for_erectile_dysfunction').hide('fast')
                $('#what_kind').val('');
                $('#how_did_it_work_natural_remedy').val('');
                $('#where_did_you_get_them').val('');
            }
        })

        $(document).on('change', 'input[type=radio][name=has_medication_been_injected_for_dysfunction_erectile]', function(){
            if ($("input[type=radio][name=has_medication_been_injected_for_dysfunction_erectile]:checked").val() == '1') {
                $('.has_medication_been_injected_for_dysfunction_erectile').show('fast')
            } else {
                $('.has_medication_been_injected_for_dysfunction_erectile').hide('fast')
                $('#how_many_times_have_injected').val('');
                $('#how_did_it_work').val('');
            }
        })

        $(document).on('change', 'input[type=radio][name=has_medication_been_injected_for_dysfunction_erectile]', function(){
            if ($("input[type=radio][name=has_medication_been_injected_for_dysfunction_erectile]:checked").val() == '1') {
                $('.has_medication_been_injected_for_dysfunction_erectile').show('fast')
            } else {
                $('.has_medication_been_injected_for_dysfunction_erectile').hide('fast')
                $('#how_many_times_have_injected').val('');
                $('#how_did_it_work').val('');
            }
        })

        $(document).on('change', 'input[type=radio][name=alcohol]', function(){
            if ($("input[type=radio][name=alcohol]:checked").val() == '1') {
                $('.alcohol').show('fast')
            } else {
                $('.alcohol').hide('fast')
                $('#volumen_alcohol').val('');
            }
        })

        $(document).on('change', 'input[type=radio][name=intravenous_drugs]', function(){
            if ($("input[type=radio][name=intravenous_drugs]:checked").val() == '1') {
                $('.intravenous_drugs').show('fast')
            } else {
                $('.intravenous_drugs').hide('fast')
                $('#description_intravenous_drugs').val('');
            }
        })

        $(document).on('change', 'input[type=radio][name=have_you_had_an_erection_longer_than_six_hours]', function(){
            if ($("input[type=radio][name=have_you_had_an_erection_longer_than_six_hours]:checked").val() == '1') {
                $('.have_you_had_an_erection_longer_than_six_hours').show('fast')
            } else {
                $('.have_you_had_an_erection_longer_than_six_hours').hide('fast')
                $('#when_you_had_a_six_hours_erection').val('');
                $('#how_was_it_resolved').val('');
                $('#did_you_get_medical_attention').val('');
            }
        })

        $(document).on('change', 'input[type=radio][name=do_you_suffer_from_penile_curvature]', function(){
            if ($("input[type=radio][name=do_you_suffer_from_penile_curvature]:checked").val() == '1') {
                $('.do_you_suffer_from_penile_curvature').show('fast')
            } else {
                $('.do_you_suffer_from_penile_curvature').hide('fast')
                $('#how_intense').val('');
                $('#which_direction').val('');
                $('#does_it_hurt').val('');
                $('#does_it_prevent_intercourse').val('');
            }
        })

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
@if (old('exerciseCadena') && count(old('exerciseCadena')))

<script>
    $("#medication_table").show('fast');
</script>
@endif

@endsection

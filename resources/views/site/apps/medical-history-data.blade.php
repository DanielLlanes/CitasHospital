@extends('site.layouts.app')
@section('title')
 - Medical History Data
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Medical History Data</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Medical History Data</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->

    <section id="team" class="team">
        <div class="container">

            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Medical History<strong> Data</strong></h2>
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
                <form action="{{ route('postMedicalHistoryData') }}" method="POST" id="formHealthData">
                    {{ csrf_field() }}
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Addictions</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addiction" id="addiction_yes" value="1" @if (old('addiction') == "1") checked @elseif(!empty($patient ?? '') && $patient->addiction == '1') checked @endif>
                                <label class="form-check-label" for="addiction_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="addiction" id="addiction_no" value="0" @if (old('addiction') == "0") checked @elseif(!empty($patient ?? '') && $patient->addiction == '0') checked @endif>
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('addiction')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row" id="which_one" @if (old('addiction') == 1)@else style="display: none" @endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Which one </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="which_one_adiction" name="which_one_adiction" value="{{ $patient->which_one_adiction ?? old('which_one_adiction') }}" placeholder="">
                            @error('which_one_adiction')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">High lipid levels</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="high_lipid_levels" id="high_lipid_levels_yes" value="1" @if (old('high_lipid_levels') == "1") checked @elseif(!empty($patient ?? '') && $patient->high_lipid_levels == '1') checked @endif>
                                <label class="form-check-label" for="if_take_medication_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="high_lipid_levels" id="high_lipid_levels_no" value="0" @if (old('high_lipid_levels') == "0") checked @elseif(!empty($patient ?? '') && $patient->high_lipid_levels == '0') checked @endif>
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('high_lipid_levels')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 high_lipid_levels" @if (old('high_lipid_levels') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_high_lipid_levels" name="date_high_lipid_levels" value="{{ $patient->date_high_lipid_levels ?? old('date_high_lipid_levels') }}" placeholder="">
                            @error('date_high_lipid_levels')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 high_lipid_levels" @if (old('high_lipid_levels') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="high_lipid_levels_treatment" name="high_lipid_levels_treatment" value="{{ $patient->high_lipid_levels_treatment ?? old('high_lipid_levels_treatment') }}" placeholder="">
                            @error('high_lipid_levels_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Arthritis</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="arthritis" id="arthritis_yes" value="1" @if (old('arthritis') == "1") checked @elseif(!empty($patient ?? '') && $patient->arthritis == '1') checked @endif>
                                <label class="form-check-label" for="arthritis_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="arthritis" id="arthritis_no" value="0" @if (old('arthritis') == "0") checked @elseif(!empty($patient ?? '') && $patient->arthritis == '0') checked @endif>
                                <label class="form-check-label" for="arthritis_no">No</label>
                            </div>
                            @error('arthritis')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 arthritis" @if (old('arthritis') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_arthritis" name="date_arthritis" value="{{ $patient->date_arthritis ?? old('date_arthritis') }}" placeholder="">
                            @error('date_arthritis')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 arthritis" @if (old('arthritis') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="arthritis_treatment" name="arthritis_treatment" value="{{ $patient->arthritis_treatment ?? old('arthritis_treatment') }}" placeholder="">
                            @error('arthritis_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Cancer</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cancer" id="cancer_yes" value="1" @if (old('cancer') == "1") checked @elseif(!empty($patient ?? '') && $patient->cancer == '1') checked @endif>
                                <label class="form-check-label" for="cancer_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cancer" id="cancer_no" value="0" @if (old('cancer') == "0") checked @elseif(!empty($patient ?? '') && $patient->cancer == '0') checked @endif>
                                <label class="form-check-label" for="cancer_no">No</label>
                            </div>
                            @error('cancer')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 cancer" @if (old('cancer') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_cancer" name="date_cancer" value="{{ $patient->date_cancer ?? old('date_cancer') }}" placeholder="">
                            @error('date_cancer')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 cancer" @if (old('cancer') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="cancer_treatment" name="cancer_treatment" value="{{ $patient->cancer_treatment ?? old('cancer_treatment') }}" placeholder="">
                            @error('cancer_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Cholesterol</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cholesterol" id="cholesterol_yes" value="1" @if (old('cholesterol') == "1") checked @elseif(!empty($patient ?? '') && $patient->cholesterol == '1') checked @endif>
                                <label class="form-check-label" for="cholesterol_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cholesterol" id="cholesterol_no" value="0" @if (old('cholesterol') == "0") checked @elseif(!empty($patient ?? '') && $patient->cholesterol == '0') checked @endif>
                                <label class="form-check-label" for="cholesterol_no">No</label>
                            </div>
                            @error('cholesterol')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 cholesterol" @if (old('cholesterol') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_cholesterol" name="date_cholesterol" value="{{ $patient->date_cholesterol ?? old('date_cholesterol') }}" placeholder="">
                            @error('date_cholesterol')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 cholesterol" @if (old('cholesterol') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="cholesterol_treatment" name="cholesterol_treatment" value="{{ $patient->cholesterol_treatment ?? old('cholesterol_treatment') }}" placeholder="">
                            @error('cholesterol_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Triglycerides</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="triglycerides" id="triglycerides_yes" value="1" @if (old('triglycerides') == "1") checked @elseif(!empty($patient ?? '') && $patient->triglycerides == '1') checked @endif>
                                <label class="form-check-label" for="triglycerides_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="triglycerides" id="triglycerides_no" value="0" @if (old('triglycerides') == "0") checked @elseif(!empty($patient ?? '') && $patient->triglycerides == '0') checked @endif>
                                <label class="form-check-label" for="triglycerides_no">No</label>
                            </div>
                            @error('triglycerides')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 triglycerides" @if (old('triglycerides') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_triglycerides" name="date_triglycerides" value="{{ $patient->date_triglycerides ?? old('date_triglycerides') }}" placeholder="">
                            @error('date_triglycerides')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 triglycerides" @if (old('triglycerides') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="triglycerides_treatment" name="triglycerides_treatment" value="{{ $patient->triglycerides_treatment ?? old('triglycerides_treatment') }}" placeholder="">
                            @error('triglycerides_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Stroke</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stroke" id="stroke_yes" value="1" @if (old('stroke') == "1") checked @elseif(!empty($patient ?? '') && $patient->stroke == '1') checked @endif>
                                <label class="form-check-label" for="stroke_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="stroke" id="stroke_no" value="0" @if (old('stroke') == "0") checked @elseif(!empty($patient ?? '') && $patient->stroke == '0') checked @endif>
                                <label class="form-check-label" for="stroke_no">No</label>
                            </div>
                            @error('stroke')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 stroke" @if (old('stroke') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_stroke" name="date_stroke" value="{{ $patient->date_stroke ?? old('date_stroke') }}" placeholder="">
                            @error('date_stroke')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 stroke" @if (old('stroke') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="stroke_treatment" name="stroke_treatment" value="{{ $patient->stroke_treatment ?? old('stroke_treatment') }}" placeholder="">
                            @error('stroke_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diabetes</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="diabetes" id="diabetes_yes" value="1" @if (old('diabetes') == "1") checked @elseif(!empty($patient ?? '') && $patient->diabetes == '1') checked @endif>
                                <label class="form-check-label" for="diabetes_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="diabetes" id="diabetes_no" value="0" @if (old('diabetes') == "0") checked @elseif(!empty($patient ?? '') && $patient->diabetes == '0') checked @endif>
                                <label class="form-check-label" for="diabetes_no">No</label>
                            </div>
                            @error('diabetes')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 diabetes" @if (old('diabetes') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_diabetes" name="date_diabetes" value="{{ $patient->date_diabetes ?? old('date_diabetes') }}" placeholder="">
                            @error('date_diabetes')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 diabetes" @if (old('diabetes') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="diabetes_treatment" name="diabetes_treatment" value="{{ $patient->diabetes_treatment ?? old('diabetes_treatment') }}" placeholder="">
                            @error('diabetes_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Coronary artery disease</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="coronary_artery_disease" id="coronary_artery_disease_yes" value="1" @if (old('coronary_artery_disease') == "1") checked @elseif(!empty($patient ?? '') && $patient->coronary_artery_disease == '1') checked @endif>
                                <label class="form-check-label" for="coronary_artery_disease_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="coronary_artery_disease" id="coronary_artery_disease_no" value="0" @if (old('coronary_artery_disease') == "0") checked @elseif(!empty($patient ?? '') && $patient->coronary_artery_disease == '0') checked @endif>
                                <label class="form-check-label" for="coronary_artery_disease_no">No</label>
                            </div>
                            @error('coronary_artery_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 coronary_artery_disease" @if (old('coronary_artery_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_coronary_artery_disease" name="date_coronary_artery_disease" value="{{ $patient->date_coronary_artery_disease ?? old('date_coronary_artery_disease') }}" placeholder="">
                            @error('date_coronary_artery_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 coronary_artery_disease" @if (old('coronary_artery_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="coronary_artery_disease_treatment" name="coronary_artery_disease_treatment" value="{{ $patient->coronary_artery_disease_treatment ?? old('coronary_artery_disease_treatment') }}" placeholder="">
                            @error('coronary_artery_disease_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Liver disease</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="liver_disease" id="liver_disease_yes" value="1" @if (old('liver_disease') == "1") checked @elseif(!empty($patient ?? '') && $patient->liver_disease == '1') checked @endif>
                                <label class="form-check-label" for="liver_disease_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="liver_disease" id="liver_disease_no" value="0" @if (old('liver_disease') == "0") checked @elseif(!empty($patient ?? '') && $patient->liver_disease == '0') checked @endif>
                                <label class="form-check-label" for="liver_disease_no">No</label>
                            </div>
                            @error('liver_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 liver_disease" @if (old('liver_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_liver_disease" name="date_liver_disease" value="{{ $patient->date_liver_disease ?? old('date_liver_disease') }}" placeholder="">
                            @error('date_liver_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 liver_disease" @if (old('liver_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="liver_disease_treatment" name="liver_disease_treatment" value="{{ $patient->liver_disease_treatment ?? old('liver_disease_treatment') }}" placeholder="">
                            @error('liver_disease_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Lugn disease</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lugn_disease" id="lugn_disease_yes" value="1" @if (old('lugn_disease') == "1") checked @elseif(!empty($patient ?? '') && $patient->lugn_disease == '1') checked @endif>
                                <label class="form-check-label" for="lugn_disease_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lugn_disease" id="lugn_disease_no" value="0" @if (old('lugn_disease') == "0") checked @elseif(!empty($patient ?? '') && $patient->lugn_disease == '0') checked @endif>
                                <label class="form-check-label" for="lugn_disease_no">No</label>
                            </div>
                            @error('lugn_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 lugn_disease" @if (old('lugn_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_lugn_disease" name="date_lugn_disease" value="{{ $patient->date_lugn_disease ?? old('date_lugn_disease') }}" placeholder="">
                            @error('date_lugn_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 lugn_disease" @if (old('lugn_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="lugn_disease_treatment" name="lugn_disease_treatment" value="{{ $patient->lugn_disease_treatment ?? old('lugn_disease_treatment') }}" placeholder="">
                            @error('lugn_disease_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Renal disease</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="renal_disease" id="renal_disease_yes" value="1" @if (old('renal_disease') == "1") checked @elseif(!empty($patient ?? '') && $patient->renal_disease == '1') checked @endif>
                                <label class="form-check-label" for="renal_disease_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="renal_disease" id="renal_disease_no" value="0" @if (old('renal_disease') == "0") checked @elseif(!empty($patient ?? '') && $patient->renal_disease == '0') checked @endif>
                                <label class="form-check-label" for="irenal_disease_no">No</label>
                            </div>
                            @error('renal_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 renal_disease" @if (old('renal_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_renal_disease" name="date_renal_disease" value="{{ $patient->date_renal_disease ?? old('date_renal_disease') }}" placeholder="">
                            @error('date_renal_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 renal_disease" @if (old('renal_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="renal_disease_treatment" name="renal_disease_treatment" value="{{ $patient->renal_disease_treatment ?? old('renal_disease_treatment') }}" placeholder="">
                            @error('renal_disease_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Thyroid disease</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="thyroid_disease" id="thyroid_disease_yes" value="1" @if (old('thyroid_disease') == "1") checked @elseif(!empty($patient ?? '') && $patient->thyroid_disease == '1') checked @endif>
                                <label class="form-check-label" for="thyroid_disease_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="thyroid_disease" id="thyroid_disease_no" value="0" @if (old('thyroid_disease') == "0") checked @elseif(!empty($patient ?? '') && $patient->thyroid_disease == '0') checked @endif>
                                <label class="form-check-label" for="thyroid_disease_no">No</label>
                            </div>
                            @error('thyroid_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 thyroid_disease" @if (old('thyroid_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_thyroid_disease" name="date_thyroid_disease" value="{{ $patient->date_thyroid_disease ?? old('date_thyroid_disease') }}" placeholder="">
                            @error('date_thyroid_disease')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 thyroid_disease" @if (old('thyroid_disease') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="thyroid_disease_treatment" name="thyroid_disease_treatment" value="{{ $patient->thyroid_disease_treatment ?? old('thyroid_disease_treatment') }}" placeholder="">
                            @error('thyroid_disease_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Hypertension</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hypertension" id="hypertension_yes" value="1" @if (old('hypertension') == "1") checked @elseif(!empty($patient ?? '') && $patient->hypertension == '1') checked @endif>
                                <label class="form-check-label" for="hypertension_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hypertension" id="hypertension_no" value="0" @if (old('hypertension') == "0") checked @elseif(!empty($patient ?? '') && $patient->hypertension == '0') checked @endif>
                                <label class="form-check-label" for="hypertension_no">No</label>
                            </div>
                            @error('hypertension')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 hypertension" @if (old('hypertension') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Diagnostic date </span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm" id="date_hypertension" name="date_hypertension" value="{{ $patient->date_hypertension ?? old('date_hypertension') }}" placeholder="">
                            @error('date_hypertension')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1 hypertension" @if (old('hypertension') == 1)@else style="display: none"@endif>
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Treatment </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="hypertension_treatment" name="hypertension_treatment" value="{{ $patient->hypertension_treatment ?? old('hypertension_treatment') }}" placeholder="">
                            @error('hypertension_treatment')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Any other illnesses</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="any_other_illnesses" id="any_other_illnesses_yes" value="1" @if (old('any_other_illnesses') == "1") checked @elseif(!empty($patient ?? '') && $patient->any_other_illnesses == '1') checked @endif>
                                <label class="form-check-label" for="any_other_illnesses_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="any_other_illnesses" id="any_other_illnesses_no" value="0" @if (old('any_other_illnesses') == "0") checked @elseif(!empty($patient ?? '') && $patient->any_other_illnesses == '0') checked @endif>
                                <label class="form-check-label" for="any_other_illnesses_no">No</label>
                            </div>
                            @error('any_other_illnesses')
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
                                    <th style="font-weight: 600; font-size: .9rem;">What other illness? </th>
                                    <th style="font-weight: 600; font-size: .9rem;">Diagnostic date</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Treatment</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty(old('illnessCadena')))
                                    @for ($i = 0; $i < count(old('illnessCadena')); $i++)
                                        <tr>
                                            <th>
                                                <input type="text" name="illness[]" class="form-control form-control-sm" value="{{ old('illnessCadena')[$i]->illness }}">
                                                @error('illness_type.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <td>
                                                <input type="date" name="diagnostic_date[]" class="form-control form-control-sm" value="{{ old('illnessCadena')[$i]->diagnostic_date }}">
                                                @error('illness_name.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="treatment[]" class="form-control form-control-sm" value="{{ old('illnessCadena')[$i]->treatment }}">
                                                @error('illness_treatment.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm btn-block deleteillness" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-second text-white mb-3" id="illnessTableAdd">Add illness</button>
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

        $(document).on('change', 'input[type=radio][name=addiction]',  function (e) {
            if ($("input[type=radio][name=addiction]:checked").val() == '1') {
                $('#which_one').show('fast')
            } else {
                $('#which_one').hide('fast')
                $('#which_one_adiction').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=high_lipid_levels]',  function (e) {
            if ($("input[type=radio][name=high_lipid_levels]:checked").val() == '1') {
                $('.high_lipid_levels').show('fast')
            } else {
                $('.high_lipid_levels').hide('fast')
                $('#date_high_lipid_levels').val('');
                $('#high_lipid_levels_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=arthritis]',  function (e) {
            if ($("input[type=radio][name=arthritis]:checked").val() == '1') {
                $('.arthritis').show('fast')
            } else {
                $('.arthritis').hide('fast')
                $('#date_arthritis').val('');
                $('#arthritis_treatment').val('');
            }
        });
        $(document).on('change', 'input[type=radio][name=cancer]',  function (e) {
            if ($("input[type=radio][name=cancer]:checked").val() == '1') {
                $('.cancer').show('fast')
            } else {
                $('.cancer').hide('fast')
                $('#date_cancer').val('');
                $('#cancer_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=cholesterol]',  function (e) {
            if ($("input[type=radio][name=cholesterol]:checked").val() == '1') {
                $('.cholesterol').show('fast')
            } else {
                $('.cholesterol').hide('fast')
                $('#date_cholesterol').val('');
                $('#cholesterol_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=triglycerides]',  function (e) {
            if ($("input[type=radio][name=triglycerides]:checked").val() == '1') {
                $('.triglycerides').show('fast')
            } else {
                $('.triglycerides').hide('fast')
                $('#date_triglycerides').val('');
                $('#triglycerides_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=stroke]',  function (e) {
            if ($("input[type=radio][name=stroke]:checked").val() == '1') {
                $('.stroke').show('fast')
            } else {
                $('.stroke').hide('fast')
                $('#date_stroke').val('');
                $('#stroke_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=diabetes]',  function (e) {
            if ($("input[type=radio][name=diabetes]:checked").val() == '1') {
                $('.diabetes').show('fast')
            } else {
                $('.diabetes').hide('fast')
                $('#date_diabetes').val('');
                $('#diabetes_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=coronary_artery_disease]',  function (e) {
            if ($("input[type=radio][name=coronary_artery_disease]:checked").val() == '1') {
                $('.coronary_artery_disease').show('fast')
            } else {
                $('.coronary_artery_disease').hide('fast')
                $('#date_coronary_artery_disease').val('');
                $('#coronary_artery_disease_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=liver_disease]',  function (e) {
            if ($("input[type=radio][name=liver_disease]:checked").val() == '1') {
                $('.liver_disease').show('fast')
            } else {
                $('.liver_disease').hide('fast')
                $('#date_liver_disease').val('');
                $('#liver_disease_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=lugn_disease]',  function (e) {
            if ($("input[type=radio][name=lugn_disease]:checked").val() == '1') {
                $('.lugn_disease').show('fast')
            } else {
                $('.lugn_disease').hide('fast')
                $('#date_lugn_disease').val('');
                $('#lugn_disease_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=renal_disease]',  function (e) {
            if ($("input[type=radio][name=renal_disease]:checked").val() == '1') {
                $('.renal_disease').show('fast')
            } else {
                $('.renal_disease').hide('fast')
                $('#date_renal_disease').val('');
                $('#renal_disease_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=thyroid_disease]',  function (e) {
            if ($("input[type=radio][name=thyroid_disease]:checked").val() == '1') {
                $('.thyroid_disease').show('fast')
            } else {
                $('.thyroid_disease').hide('fast')
                $('#date_thyroid_disease').val('');
                $('#thyroid_disease_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=hypertension]',  function (e) {
            if ($("input[type=radio][name=hypertension]:checked").val() == '1') {
                $('.hypertension').show('fast')
            } else {
                $('.hypertension').hide('fast')
                $('#date_hypertension').val('');
                $('#hypertension_treatment').val('');
            }
        });

        $(document).on('change', 'input[type=radio][name=any_other_illnesses]',  function (e) {
            if ($("input[type=radio][name=any_other_illnesses]:checked").val() == '1') {
                $('#medication_table').show('fast')
                addillnessFields()
            } else {
                $('#medication_table').hide('fast')
                $('#medication_table').find('tbody').html('');
            }
        });

        $(document).on('click', ".cancel", function(e) {
            e.preventDefault
            $('.reset').click();
            clearForm()
        })

        function clearForm() {
            $('#which_one').hide('fast');
            $('#which_one_adiction').val('');
            $('.high_lipid_levels').hide('fast');
            $('#date_high_lipid_levels').val('');
            $('#high_lipd_levels_treatment').val('');
            $('.arthritis').hide('fast')
            $('#date_arthritis').val('');
            $('#arthritis_treatment').val('');
            $('.cancer').hide('fast')
            $('#date_cancer').val('');
            $('#cancer_treatment').val('');
            $('.cholesterol').hide('fast')
            $('#date_cholesterol').val('');
            $('#cholesterol_treatment').val('');
            $('.triglycerides').hide('fast')
            $('#date_triglycerides').val('');
            $('#triglycerides_treatment').val('');
            $('.stroke').hide('fast')
            $('#date_stroke').val('');
            $('#stroke_treatment').val('');
            $('.diabetes').hide('fast')
            $('#date_diabetes').val('');
            $('#diabetes_treatment').val('');
            $('.coronary_artery_disease').hide('fast')
            $('#date_coronary_artery_disease').val('');
            $('#coronary_artery_disease_treatment').val('');
            $('.liver_disease').hide('fast')
            $('#date_liver_disease').val('');
            $('#liver_disease_treatment').val('');
            $('.lugn_disease').hide('fast')
            $('#date_lugn_disease').val('');
            $('#lugn_disease_treatment').val('');
            $('.renal_disease').hide('fast')
            $('#date_renal_disease').val('');
            $('#renal_diseasetreatment').val('');
            $('.thyroid_disease').hide('fast')
            $('#date_thyroid_disease').val('');
            $('#thyroid_disease_treatment').val('');
            $('.hypertension').hide('fast')
            $('#date_hypertension').val('');
            $('#hypertension_treatment').val('');
        }
        $(document).on('click', '#illnessTableAdd',function () {
            $('.formError').html('')
            addillnessFields()
        });

        $(document).on('click', '.deleteillness', function(event) {
            $(this).parents('tr').remove()

            console.log($("#medication_table tbody tr").length);

            if ($("#medication_table tbody tr").length < 1) {
                addillnessFields()
            }

        });

        function addillnessFields() {
            var medicationField = '';
            medicationField += '<tr>'
            medicationField += '<th>'
            medicationField += '<input type="text" name="illness[]" class="form-control form-control-sm">'
            medicationField += '</th>'
            medicationField += '<td>'
            medicationField += '<input type="date" name="diagnostic_date[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="treatment[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<td class="text-center">'
            medicationField += '<button class="btn btn-danger btn-sm deleteillness" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>'
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
@if (old('illnessCadena') && count(old('illnessCadena')))
<script>
    $("#medication_table").show('fast');
</script>
@endif

@endsection

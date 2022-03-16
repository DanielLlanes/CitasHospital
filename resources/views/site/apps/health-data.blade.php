@extends('site.layouts.app')
@section('title')
 - Health Data
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Health Data</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Health Data</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->

    <section id="team" class="team">
        <div class="container">

            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Health<strong> Data</strong></h2>
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
               {{ $app->drugs_sulfa }}
                <form action="{{ route('postHealthData') }}" method="POST" id="formHealthData">
                    {{ csrf_field() }}
                    <div class="mb-2 row">
                        <div class="col-3"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm text-center">Select your preferred measurement system</p>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9 text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mesure_sistem" id="mesureSistemMetric" value="M" @if (old('mesure_sistem') == "M") checked @elseif(!empty($app) && $app->mesure_sistem == 'M') checked @endif>
                                <label class="form-check-label" for="mesureSistemMetric">Metrico ( kg - meters )</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="mesure_sistem" id="mesureSistemImperial" value="I" @if (old('mesure_sistem') == "x") checked @elseif(!empty($app) && $app->mesure_sistem == 'x') checked @endif>
                                <label class="form-check-label" for="mesureSistemImperial">Imperial ( lb - in )</label>
                            </div>
                            @error('mesure_sistem')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Max Weigth <span class="fw-bold" id="mw"> (Lb)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="max_weigh" name="max_weigh" value="{{ $app->max_weigh ?? old('max_weigh') }}" placeholder="">
                            @error('max_weigh')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Current Weigth <span class="fw-bold" id="cw"> (Lb)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="weight" name="weight" value="{{ $app->weight ?? old('weight') }}" placeholder="">
                            @error('weight')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Heigth <span class="fw-bold" id="h"> (Ft)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="height" name="height" value="{{ $app->height ?? old('height') }}" placeholder="">
                            @error('height')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">IMC</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="imc" name="imc" value="{{ $app->imc ?? old('imc') }}" placeholder="">
                            @error('imc')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Do you take any medications/drugs?</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="take_medication" id="if_take_medication_yes" value="1" @if (old('take_medication') == "1") checked @elseif(!empty($app) && $app->if_take_medication == '1') checked @endif>
                                <label class="form-check-label" for="if_take_medication_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="take_medication" id="if_take_medication_no" value="0" @if (old('take_medication') == "0") checked @elseif(!empty($app) && $app->if_take_medication == '0') checked @endif>
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('take_medication')
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
                                    <th style="font-weight: 600; font-size: .9rem;">Medication name</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Reazon</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Dose</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Frecuency</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty(old('medicationCadena')))
                                    @for ($i = 0; $i < count(old('medicationCadena')); $i++)
                                        <tr>
                                            <th>
                                                <input type="text" name="medication_name[]" class="form-control form-control-sm" value="{{ old('medicationCadena')[$i]->medication_name }}">
                                                @error('medication_name.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <td>
                                                <input type="text" name="medication_reason[]" class="form-control form-control-sm" value="{{ old('medicationCadena')[$i]->medication_reason }}">
                                                @error('medication_reason.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="medication_dosage[]" class="form-control form-control-sm" value="{{ old('medicationCadena')[$i]->medication_dosage }}">
                                                @error('medication_dosage'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="medication_frecuency[]" class="form-control form-control-sm" value="{{ old('medicationCadena')[$i]->medication_frecuency }}">
                                                @error('medication_frecuency.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm btn-block deleteMedication" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                                @if (!empty($app->medications) && empty(old('medicationCadena')))
                                    @for ($i = 0; $i < count($app->medications); $i++)
                                        <tr>
                                            <th>
                                                <input type="text" name="medication_name[]" class="form-control form-control-sm" value="{{ $app->medications[$i]->name }}">
                                                @error('medication_name.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <td>
                                                <input type="text" name="medication_reason[]" class="form-control form-control-sm" value="{{ $app->medications[$i]->reason }}">
                                                @error('medication_reason.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="medication_dosage[]" class="form-control form-control-sm" value="{{ $app->medications[$i]->dosage }}">
                                                @error('medication_dosage'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="medication_frecuency[]" class="form-control form-control-sm" value="{{ $app->medications[$i]->frecuency }}">
                                                @error('medication_frecuency.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm btn-block deleteMedication" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>
                                            </td>
                                        </tr>
                                    @endfor
                                @endif
                            </tbody>
                        </table>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-second text-white mb-3" id="medicationTableAdd">Add Medication</button>
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Do you take, or have you taken in the past Blood-thinners?</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="blood_thinners" id="if_blood_thinners_yes" value="1" @if (old('blood_thinners') == "1") checked @elseif(!empty($app) && $app->if_take_blood_thinners == '1') checked @endif>
                                <label class="form-check-label" for="if_blood_thinners_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="blood_thinners" id="if_blood_thinners_no" value="0" @if (old('blood_thinners') == "0") checked @elseif(!empty($app) && $app->if_take_blood_thinners == '0') checked @endif>
                                <label class="form-check-label" for="if_blood_thinners_no">No</label>
                            </div>
                            @error('blood_thinners')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row" id="rbt" style="display: none">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Explain the reason</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="razon_blood_thinners" name="razon_blood_thinners" value="{{ $app->razon_blood_thinners ?? old('razon_blood_thinners') }}" placeholder="">
                            @error('razon_blood_thinners')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Do you suﬀer from acid reflux?</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_ralery" value="rarely" @if (old('acid_reflux') == "rarely") checked @elseif(!empty($app) && $app->acid_reflux == 'rarely') checked @endif>
                                <label class="form-check-label" for="if_acid_reflux_ralery">Rarely</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_occasionally" value="occasionally" @if (old('acid_reflux') == "occasionally") checked @elseif(!empty($app) && $app->acid_reflux == 'occasionally') checked @endif>
                                <label class="form-check-label" for="if_acid_reflux_occasionally">Occasionally</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_frequently" value="frequently" @if (old('acid_reflux') == "frequently") checked @elseif(!empty($app) && $app->acid_reflux == 'frequently') checked @endif>
                                <label class="form-check-label" for="if_acid_reflux_frequently">Frequently</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_no" value="no" @if (old('acid_reflux') == "no") checked @elseif(!empty($app) && $app->acid_reflux == 'no') checked @endif>
                                <label class="form-check-label" for="if_acid_reflux_no">No</label>
                            </div>
                            @error('acid_reflux')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">penicillin allergy</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="penicilin" id="if_penicilin_yes" value="1" @if (old('penicilin') == "1") checked @elseif(!empty($app) && $app->penicilin == '1') checked @endif>
                                <label class="form-check-label" for="if_penicilin_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="penicilin" id="if_penicilin_no" value="0" @if (old('penicilin') == "0") checked @elseif(!empty($app) && $app->penicilin == '0') checked @endif>
                                <label class="form-check-label" for="if_penicilin_no">No</label>
                            </div>
                            @error('penicilin')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Sulfa Drugs</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="drugs_sulfa" id="if_sulfa_drugs_yes" value="1" @if (old('drugs_sulfa') == "1") checked @elseif(!empty($app) && $app->drugs_sulfa == '1') checked @endif>
                                <label class="form-check-label" for="if_drugs_sulfa_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="drugs_sulfa" id="if_drugs_sulfa" value="0" @if (old('drugs_sulfa') == "0") checked @elseif(!empty($app) && $app->drugs_sulfa == '0') checked @endif>
                                <label class="form-check-label" for="if_drugs_sulfa_no">No</label>
                            </div>
                            @error('drugs_sulfa')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Iodine allergy</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="iodine" id="if_odine_yes" value="1" @if (old('iodine') == "1") checked @elseif(!empty($app) && $app->iodine == '1') checked @endif>
                                <label class="form-check-label" for="if_iodine_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="iodine" id="if_odine_no" value="0" @if (old('iodine') == "0") checked @elseif(!empty($app) && $app->iodine == '0') checked @endif>
                                <label class="form-check-label" for="if_iodine_no">No</label>
                            </div>
                            @error('iodine')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Tape allergy</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tape" id="if_tape_yes" value="1" @if (old('tape') == "1") checked @elseif(!empty($app) && $app->tape == '1') checked @endif>
                                <label class="form-check-label" for="if_tape_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tape" id="if_tape_no" value="0" @if (old('tape') == "0") checked @elseif(!empty($app) && $app->tape == '0') checked @endif>
                                <label class="form-check-label" for="if_tape_no">No</label>
                            </div>
                            @error('tape')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Latex allergy</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="latex" id="if_latex_yes" value="1" @if (old('latex') == "1") checked @elseif(!empty($app) && $app->latex == '1') checked @endif>
                                <label class="form-check-label" for="if_latex_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="latex" id="if_latex_no" value="0" @if (old('penicilin') == "0") checked @elseif(!empty($app) && $app->penicilin == '0') checked @endif>
                                <label class="form-check-label" for="if_latex_no">No</label>
                            </div>
                            @error('latex')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Aspirin allergy</p>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aspirin" id="if_aspirin_yes" value="1" @if (old('aspirin') == "1") checked @elseif(!empty($app) && $app->aspirin == '1') checked @endif>
                                <label class="form-check-label" for="if_aspirin_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aspirin" id="if_aspirin_no" value="0" @if (old('aspirin') == "0") checked @elseif(!empty($app) && $app->aspirin == '0') checked @endif>
                                <label class="form-check-label" for="if_aspirin_no">No</label>
                            </div>
                            @error('aspirin')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Other allergy </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="other_allergy" name="other_allergy" value="{{ $app->describe_other_allergy ?? old('other_allergy') }}" placeholder="">
                            @error('other_allergy')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong class="error">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-6">
                            @if (!$treatment->service->need_images)
                                <a href="{{ route('appIndex', ['id' => $treatment->id]) }}" class="btn btn-main btn-sm mx-1">Back</a>
                            @else
                                <a href="{{ route('createServicesData') }}" class="btn btn-main btn-sm mx-1">Back</a>
                            @endif
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-main btn-sm mx-1 send">Next</button>
                            <button type="button" class="btn btn-main btn-sm mx-1 cancel">Cancel</button>
                            <button type="reset" class="d-none reset">Reset</button>
                        </div>
                    </div>
                </form>
            <div class="col-md-4 d-none d-md-block"></div>
        </div>
    </section>
    <div class="modal fade" id="medicationModal" tabindex="-1" aria-labelledby="medicationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Medication Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="FormModalMedication">
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Medication name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="medicationNameForm" name="medicationNameForm" value="" placeholder="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Razon</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="medicationRazonForm" name="medicationRazonForm" placeholder="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Doce</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="medicationDoseForm" name="medicationDoseForm" placeholder="">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Frecuency</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="medicationFrecuencyForm" name="medicationFrecuencyForm" placeholder="">
                            </div>
                        </div>
                        <div class="formError text-danger"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-second text-white cancel" id="medicationFormCancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-main" id="medicationFormSave">Save Medication</button>
                        <button type="button" class="btn btn-warning text-white" id="medicationFormEdit">Edit Medication</button>
                        <button type="reset" class="d-none reset" id="medicationFormReset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Contact Section -->
</main>
@endsection

@section('scripts')
    <script>
        var globalRouteobtenerEstados = "{{ route('getStates') }}";
        var globalRoutechekIfPatientExist = "{{ route('chekIfPatientExist') }}";
        var globalRouteDeleteSessionVar = "{{ route('deleteSessionVarAndDeleteApp') }}";
    </script>

    <script>
        const containerMedicactionModal = document.getElementById("medicationModal");
        const medicationModal = new bootstrap.Modal(containerMedicactionModal);
        const medication_cadena = [];
        $(document).ready(function() {
            $('#imc').attr('readOnly', true);
        });

        $(document).on("change", "#weight", function () {
            var sistem = $("input[type=radio][name=mesure_sistem]:checked").val()
            if ($("#height").val()!= "") {
                ImcCalculate(sistem)
            }

        });

        $(document).on("change", "#height", function () {
            var sistem = $("input[type=radio][name=mesure_sistem]:checked").val()
            if ($("#weight").val()!= "") {
                ImcCalculate(sistem)
            }
        });

        $(document).on('click', '#medicationFormSave', function () {
            $('#medicationFormSave').show('fast');
            $('.formError').html('')

        });

        $(document).on('click', '.deleteMedication', function(event) {
            console.log($("#medication_table tbody tr").length);
            $(this).parents('tr').remove()

            if ($("#medication_table tbody tr").length < 1) {
                addMedicationFields()
            }
        });

        $(document).on('click', '#medicationTableAdd',function () {
            $('.formError').html('')
            addMedicationFields()
        });

        function ImcCalculate(sistem) {
            if (sistem == "M") {
                var altura = $("#height").val()
                var peso = $("#weight").val()

                var formula = peso / (altura * altura);
                $("#imc").val(formula.toFixed(2))
            } else if (sistem =="I"){
                var altura = $("#height").val() * $("#height").val();
                var peso = $("#weight").val() * 703;

                var formula = peso / altura;
                $("#imc").val(formula.toFixed(2))
            }
        }

        $(document).on('change', 'input[type=radio][name=take_medication]',  function (e) {
            if ($("input[type=radio][name=take_medication]:checked").val() == '1') {
                $('#medication_table').show('fast')
                $('#medicationFormEdit').hide('fast');
                $('.formError').html('')
                addMedicationFields()
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

        $(document).on('change', 'input[type=radio][name=mesure_sistem]',  function() {
            $("#max_weigh").val("");
            $("#weight").val("");
            $("#height").val("");
            $("#imc").val("");
            if ($(this).val() == 'I') {
                $('#mw').html(' (Lb)')
                $('#cw').html(' (Lb)')
                $('#h').html(' (Ft)')
            } else if($(this).val() == 'M'){
                $('#mw').html(' (Kg)')
                $('#cw').html(' (Kg)')
                $('#h').html(' (Mts)')
            }
        });

        $(document).on('change', 'input[type=radio][name=blood_thinners]',  function() {
            if ($("input[type=radio][name=blood_thinners]:checked").val() == '1') {
                $("#rbt").show('fast')
            } else {
                $("#rbt").hide('fast')
                $('#razon_blood_thinners').val('')
            }
        });

        $(document).on('click', '.send', function(e){
            e.preventDefault();
            console.log(medication_cadena.length);
            if (medication_cadena.length > 0) {
                $('#formHealthData').append("<input type='hidden' name='medication_cadena' value='" + JSON.stringify(medication_cadena) +"'>")
            }
            $('form#formHealthData').submit();
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

        function createTableRow(){
            var tableRow = '';
            tableRow += '<tr>'
            tableRow += '<th style="font-weight: 500; font-size: .9rem;"></th>'
            tableRow += '<td style="font-weight: 500; font-size: .9rem;"></td>'
            tableRow += '<td style="font-weight: 500; font-size: .9rem;"></td>'
            tableRow += '<td style="font-weight: 500; font-size: .9rem;"></td>'
            tableRow += '<td style="font-weight: 500; font-size: .9rem;">'
            tableRow += '<div class="row">'
            tableRow += '<div class="col-4 g-0 text-center"><i class="bi bi-trash"></i></div>'
            tableRow += '<div class="col-4 g-0 text-center"><i class="bi bi-trash"></i></div>'
            tableRow += '<div class="col-4 g-0 text-center"><i class="bi bi-trash"></i></div>'
            tableRow += '</div>'
            tableRow += '</td>'
            tableRow += '</tr>'

            $('#medication_table  tbody').append(tableRow)
        }

        $('#medicationModal').on('hidden.bs.modal', function(e) {
            var nFilas = $("#medication_table .table tbody tr").length;
            if (nFilas == '0') {
                $('#medication_table').hide('fast')
                $('#medication_table').find('tbody').html('');
                $("input[name=take_medication][value=0]").prop('checked', true);
            }
            $("#FormModalMedication")[0].reset();
        });

        function addMedicationFields() {
            var medicationField = '';
            medicationField += '<tr>'
            medicationField += '<th>'
            medicationField += '<input type="text" name="medication_name[]" class="form-control form-control-sm">'
            medicationField += '</th>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="medication_reason[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="medication_dosage[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="medication_frecuency[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td class="text-center">'
            medicationField += '<button class="btn btn-danger btn-sm btn-block deleteMedication" type="button" id="addon-wrapping"><i class="bi bi-trash-fill"></i></button>'
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
@if (old('medicationCadena') && count(old('medicationCadena')) || !empty($app->medications) && count($app->medications) > 0)
<script>
    $("#medication_table").show('fast');
</script>
@endif
@if (old('blood_thinners') == 1 || !empty($app) && $app->if_take_blood_thinners == 1)
    <script>
        $("#rbt").show('fast')
    </script>
@endif

@endsection

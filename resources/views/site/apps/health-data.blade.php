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
                                <input class="form-check-input" type="radio" name="mesure_sistem" id="if_take_medication_yes" value="M">
                                <label class="form-check-label" for="if_take_medication_yes">Metrico ( kg - meters )</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" checked name="mesure_sistem" id="mesureSistemimperial" value="I">
                                <label class="form-check-label" for="mesureSistemimperial">Imperial ( lb - in )</label>
                            </div>
                            @error('mesure_sistem')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Max Weigth <span class="fw-bold" id="mw"> (Lb)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="max_weigh" name="max_weigh" value="{{ $patient->max_weigh ?? old('max_weigh') }}" placeholder="">
                            @error('max_weigh')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Current Weigth <span class="fw-bold" id="cw"> (Lb)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="weight" name="weight" value="{{ $patient->weight ?? old('weight') }}" placeholder="">
                            @error('weight')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Heigth <span class="fw-bold" id="h"> (Ft)</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="height" name="height" value="{{ $patient->height ?? old('height') }}" placeholder="">
                            @error('height')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">IMC</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="imc" name="imc" value="{{ $patient->imc ?? old('imc') }}" placeholder="">
                            @error('imc')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="take_medication" id="if_take_medication_yes" value="1">
                                <label class="form-check-label" for="if_take_medication_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="take_medication" id="if_take_medication_no" value="0">
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('take_medication')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="blood_thinners" id="if_blood_thinners_yes" value="1">
                                <label class="form-check-label" for="if_blood_thinners_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="blood_thinners" id="if_blood_thinners_no" value="0">
                                <label class="form-check-label" for="if_blood_thinners_no">No</label>
                            </div>
                            @error('blood-thinners')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row" id="rbt" style="display: none">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Explain the reason</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="razon_blood_thinners" name="razon_blood_thinners" value="{{ $patient->razon_blood_thinners ?? old('razon_blood_thinners') }}" placeholder="">
                            @error('razon_blood_thinners')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_ralery" value="rarely">
                                <label class="form-check-label" for="if_acid_reflux_ralery">Rarely</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_occasionally" value="occasionally">
                                <label class="form-check-label" for="if_acid_reflux_occasionally">Occasionally</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_frequently" value="frequently">
                                <label class="form-check-label" for="if_acid_reflux_frequently">Frequently</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="acid_reflux" id="if_acid_reflux_no" value="no">
                                <label class="form-check-label" for="if_acid_reflux_no">No</label>
                            </div>
                            @error('acid_reflux')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="penicilin" id="if_penicilin_yes" value="1">
                                <label class="form-check-label" for="if_penicilin_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="penicilin" id="if_penicilin_no" value="0">
                                <label class="form-check-label" for="if_penicilin_no">No</label>
                            </div>
                            @error('penicilin')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="sulfa_drugs" id="if_sulfa_drugs_yes" value="1">
                                <label class="form-check-label" for="if_sulfa_drugs_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sulfa_drugs" id="if_sulfa_drugs_no" value="0">
                                <label class="form-check-label" for="if_sulfa_drugs_no">No</label>
                            </div>
                            @error('sulfa_drugs')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="iodine" id="if_odine_yes" value="1">
                                <label class="form-check-label" for="if_iodine_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="iodine" id="if_odine_no" value="0">
                                <label class="form-check-label" for="if_iodine_no">No</label>
                            </div>
                            @error('iodine')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="tape" id="if_tape_yes" value="1">
                                <label class="form-check-label" for="if_tape_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tape" id="if_tape_no" value="0">
                                <label class="form-check-label" for="if_tape_no">No</label>
                            </div>
                            @error('tape')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="latex" id="if_latex_yes" value="1">
                                <label class="form-check-label" for="if_latex_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="latex" id="if_latex_no" value="0">
                                <label class="form-check-label" for="if_latex_no">No</label>
                            </div>
                            @error('latex')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
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
                                <input class="form-check-input" type="radio" name="aspirin" id="if_aspirin_yes" value="1">
                                <label class="form-check-label" for="if_aspirin_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aspirin" id="if_aspirin_no" value="0">
                                <label class="form-check-label" for="if_aspirin_no">No</label>
                            </div>
                            @error('aspirin')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row mt-1">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Other allergy </span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="other_allergy" name="other_allergy" value="{{ $patient->other_allergy ?? old('other_allergy') }}" placeholder="">
                            @error('other_allergy')
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            @if (!$product->service->need_images)
                                <a href="{{ route('appIndex', ['id' => $product->id]) }}" class="btn btn-main btn-sm mx-1">Back</a>
                            @else
                                <a href="{{ route('createServicesData') }}" class="btn btn-main btn-sm mx-1">Back</a>
                            @endif


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
        const mediacation_cadena = [];
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
            var medicationNameForm = $('#medicationNameForm').val();
            var medicationRazonForm = $('#medicationRazonForm').val();
            var medicationDoseForm = $('#medicationDoseForm').val();
            var medicationFrecuencyForm = $('#medicationFrecuencyForm').val();
            var nFilas = $("#medication_table tbody tr").length;
            nFilas = (nFilas+1)
            console.log(nFilas);
            if (!medicationNameForm, !medicationRazonForm, !medicationDoseForm, !medicationFrecuencyForm) {
                $('.formError').html('Please fill in all the fields')
            } else {
                mediacation_cadena.push(
                    {
                        id: nFilas,
                        medication_name: medicationNameForm,
                        medication_reason: medicationRazonForm,
                        medication_dosage: medicationDoseForm ,
                        medication_frecuency: medicationFrecuencyForm
                    }
                );
            }
            $('#medication_table .table tbody').html('');
            medicationModal.hide()
            $("#FormModalMedication")[0].reset();
            for (var i = 0; i < mediacation_cadena.length; i++) {
                var tableRow = '';
                tableRow += '<tr>'
                tableRow += '<th style="font-weight: 500; font-size: .9rem; display: none">' + mediacation_cadena[i].id + '</th>'
                tableRow += '<th style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_name + '</th>'
                tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_reason + '</td>'
                tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_dosage + '</td>'
                tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_frecuency + '</td>'
                tableRow += '<td style="font-weight: 500; font-size: .9rem;">'
                tableRow += '<div class="row">'
                tableRow += '<div class="col-6 g-0 text-center"><i class="bi bi-trash text-danger deleteMedication" deleteMedication="' + mediacation_cadena[i].id + '" style="cursor: pointer"></i></div>'
                tableRow += '<div class="col-6 g-0 text-center"><i class="bi bi-pencil text-info editMedication" editMedication="' + mediacation_cadena[i].id + '" style="cursor: pointer"></i></div>'
                tableRow += '</div>'
                tableRow += '</td>'
                tableRow += '</tr>'
                $('#medication_table tbody').append(tableRow)

            }
        });

        $(document).on('click', '.deleteMedication', function(event) {
            event.preventDefault();
            var index = $(this).attr('deleteMedication');
            var objIndex = mediacation_cadena.findIndex((obj => obj.id == index));
            mediacation_cadena.splice(objIndex,  1);
            if (mediacation_cadena.length > 0) {
                $('#medication_table tbody').html('');
                for (var i = 0; i < mediacation_cadena.length; i++) {
                    var tableRow = '';
                    tableRow += '<tr>'
                    tableRow += '<th style="font-weight: 500; font-size: .9rem; display: none">' + mediacation_cadena[i].id + '</th>'
                    tableRow += '<th style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_name + '</th>'
                    tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_reason + '</td>'
                    tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_dosage + '</td>'
                    tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_frecuency + '</td>'
                    tableRow += '<td style="font-weight: 500; font-size: .9rem;">'
                    tableRow += '<div class="row">'
                    tableRow += '<div class="col-6 g-0 text-center"><i class="bi bi-trash text-danger deleteMedication" deleteMedication="' + mediacation_cadena[i].id + '" style="cursor: pointer"></i></div>'
                    tableRow += '<div class="col-6 g-0 text-center"><i class="bi bi-pencil text-info editMedication" editMedication="' + mediacation_cadena[i].id + '" style="cursor: pointer"></i></div>'
                    tableRow += '</div>'
                    tableRow += '</td>'
                    tableRow += '</tr>'
                    $('#medication_table tbody').append(tableRow)
                }
            } else {
                $('#medication_table tbody').html('');
                $('#medicationFormEdit').hide('fast');
                $('#medication_table').hide('fast')
                $("input[name=take_medication][value=0]").prop('checked', true);
            }
        });

        $(document).on('click', '.editMedication', function(event) {
            event.preventDefault();
            var index = $(this).attr('editMedication');
            var objIndex = mediacation_cadena.findIndex((obj => obj.id == index));
            $('#medicationFormSave').hide('fast')
            $('#medicationFormEdit').show('fast').attr('edit', mediacation_cadena[objIndex].id)

            $('#medicationModal').on('show.bs.modal', function (e) {
                $(this).find('#medicationNameForm').val(mediacation_cadena[objIndex].medication_name)
                $(this).find('#medicationRazonForm').val(mediacation_cadena[objIndex].medication_reason)
                $(this).find('#medicationDoseForm').val(mediacation_cadena[objIndex].medication_dosage)
                $(this).find('#medicationFrecuencyForm').val(mediacation_cadena[objIndex].medication_frecuency)
                $('#modal-edit-table').show('fast');
                $('#modal-edit-table').attr('edit', mediacation_cadena[objIndex].id);
                $('#modal-medication-table').hide('fast');
            }).modal('show');
        });

        $(document).on('click', '#medicationFormEdit',function () {
            event.preventDefault();
            var index = $(this).attr('edit');
            var objIndex = mediacation_cadena.findIndex((obj => obj.id == index));
            mediacation_cadena[objIndex].medication_name = $('#medicationNameForm').val();
            mediacation_cadena[objIndex].medication_reason = $('#medicationRazonForm').val();
            mediacation_cadena[objIndex].medication_dosage = $('#medicationDoseForm').val();
            mediacation_cadena[objIndex].medication_frecuency = $("#medicationFrecuencyForm").val()
            if (mediacation_cadena.length > 0) {
                $('#medication_table tbody').html('');
                for (var i = 0; i < mediacation_cadena.length; i++) {
                    var tableRow = '';
                    tableRow += '<tr>'
                    tableRow += '<th style="font-weight: 500; font-size: .9rem; display: none">' + mediacation_cadena[i].id + '</th>'
                    tableRow += '<th style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_name + '</th>'
                    tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_reason + '</td>'
                    tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_dosage + '</td>'
                    tableRow += '<td style="font-weight: 500; font-size: .9rem;">' + mediacation_cadena[i].medication_frecuency + '</td>'
                    tableRow += '<td style="font-weight: 500; font-size: .9rem;">'
                    tableRow += '<div class="row">'
                    tableRow += '<div class="col-6 g-0 text-center"><i class="bi bi-trash text-danger deleteMedication" deleteMedication="' + mediacation_cadena[i].id + '" style="cursor: pointer"></i></div>'
                    tableRow += '<div class="col-6 g-0 text-center"><i class="bi bi-pencil text-info editMedication" editMedication="' + mediacation_cadena[i].id + '" style="cursor: pointer"></i></div>'
                    tableRow += '</div>'
                    tableRow += '</td>'
                    tableRow += '</tr>'
                $('#medication_table tbody').append(tableRow)
                }
            }
            $('.reset').click();
            medicationModal.hide()
            $('#medicationFormEdit').removeAttr('edit').hide('fast')
            $('#medicationFormSave').show('fast')

        });

        $(document).on('click', '#medicationTableAdd',function () {
            $('.formError').html('')
            $("#FormModalMedication")[0].reset();
            medicationModal.show()
            $('.reset').click();
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
                medicationModal.show()
            } else {
                $('#medication_table').hide('fast')
                $('#medication_table').find('tbody').html('');
                mediacation_cadena = [];
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

        // $(document).on('click', '.send', function(e){
        //     e.preventDefault();
        //     if (mediacation_cadena.length > 0) {
        //         $('#formHealthData').append("<input type='hidden' name='mediacation_cadena' value='" + JSON.stringify(mediacation_cadena) +"'>")
        //     }
        //
        // });

        $(document).on('submit', '#formHealthData', function(){
            e.preventDefault();
            if (mediacation_cadena.length > 0) {
                $('#formHealthData').append("<input type='hidden' name='mediacation_cadena[]' value='" + JSON.stringify(mediacation_cadena) +"'>")
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
</script>
@endif

@endsection

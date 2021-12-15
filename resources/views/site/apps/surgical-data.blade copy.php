@extends('site.layouts.app')
@section('title')
 - Surgical Data
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Surgical Data</h2>
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li>Surgical Data</li>
                </ol>
            </div>

        </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->

    <section id="team" class="team">
        <div class="container">

            <div class="section-title mb-5" data-aos="fade-up">
                <h2>Surgical<strong> Data</strong></h2>
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
                <form action="{{ route('postSurgicalData') }}" method="POST" id="formHealthData">
                    {{ csrf_field() }}
                    <div class="mb-2 row">
                        <div class="col-3 d-none d-md-block"></div>
                        <div class="col-sm-9">
                            <p for="staticEmail" class="col-form-label col-form-label-sm">Have you had any previous surgery?</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="previus_surgery" id="if_take_medication_yes" value="1" @if (old('previus_surgery') == "1") checked @elseif(!empty($patient ?? '') && $patient->previus_surgery == '1') checked @endif>
                                <label class="form-check-label" for="if_take_medication_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="previus_surgery" id="if_take_medication_no" value="0" @if (old('previus_surgery') == "0") checked @elseif(!empty($patient ?? '') && $patient->previus_surgery == '0') checked @endif>
                                <label class="form-check-label" for="if_take_medication_no">No</label>
                            </div>
                            @error('previus_surgery')
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
                                    <th style="font-weight: 600; font-size: .9rem;">Name</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Age</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Year</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Complications</th>
                                    <th style="font-weight: 600; font-size: .9rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty(old('surgeyCadena')))
                                    @for ($i = 0; $i < count(old('surgeyCadena')); $i++)
                                        <tr>
                                            <th>
                                                <input type="text" name="surgey_type[]" class="form-control form-control-sm" value="{{ old('surgeyCadena')[$i]->surgey_type }}">
                                                @error('surgey_type.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </th>
                                            <td>
                                                <input type="text" name="surgey_name[]" class="form-control form-control-sm" value="{{ old('surgeyCadena')[$i]->surgey_name }}">
                                                @error('surgey_name.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="surgey_age[]" class="form-control form-control-sm" value="{{ old('surgeyCadena')[$i]->surgey_age }}">
                                                @error('surgey_age.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="surgey_year[]" class="form-control form-control-sm" value="{{ old('surgeyCadena')[$i]->surgey_year }}">
                                                @error('surgey_year.'.$i)
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong class="error">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" name="surgey_complications[]" class="form-control form-control-sm" value="{{ old('surgeyCadena')[$i]->surgey_complications }}">
                                                @error('surgey_complications.'.$i)
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
                            <button type="button" class="btn btn-second text-white mb-3" id="surgeyTableAdd">Add surgery</button>
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
                addMedicationFields()
            }

        });

        $(document).on('click', '#surgeyTableAdd',function () {
            $('.formError').html('')
            addMedicationFields()
        });

        $(document).on('change', 'input[type=radio][name=previus_surgery]',  function (e) {

            if ($("input[type=radio][name=previus_surgery]:checked").val() == '1') {
                $('#medication_table').show('fast')
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


        function addMedicationFields() {
            var medicationField = '';
            medicationField += '<tr>'
            medicationField += '<th>'
            medicationField += '<input type="text" name="surgey_type[]" class="form-control form-control-sm">'
            medicationField += '</th>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="surgey_name[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="surgey_age[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="surgey_year[]" class="form-control form-control-sm">'
            medicationField += '</td>'
            medicationField += '<td>'
            medicationField += '<input type="text" name="surgey_complications[]" class="form-control form-control-sm">'
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
@if (!empty(old('surgeyCadena')))
<script>
    $("#medication_table").show('fast');
</script>
@endif

@endsection

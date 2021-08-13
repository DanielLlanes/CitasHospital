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
                <form action="" method="post">
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
                                <input class="form-check-input" type="radio" name="treatmentBefore" id="treatmentBeforeYes" value="1">
                                <label class="form-check-label" for="treatmentBeforeYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="treatmentBefore" id="treatmentBeforeNo" value="0">
                                <label class="form-check-label" for="treatmentBeforeNo">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="email" name="email" value="email@example.com">
                        </div>
                    </div>
                    <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-sm" id="name" name="name">
                            </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Biological Sex</label>
                        <div class="col-sm-9">
                            <select name="sex" id="sex" class="form-control form-control-sm">
                                <option value="" disabled selected>Select....</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Birth Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="dob" name="dob">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Age</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="age" name="age">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Mobile</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="mobile" name="mobile">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="address" name="address">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Country</label>
                        <div class="col-sm-9">
                            <select name="countries" id="countries" class="form-control form-control-sm">
                                <option value="" disabled selected>Select....</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">State </label>
                        <div class="col-sm-9">
                            <select name="state" id="state" class="form-control form-control-sm">
                                <option value="" disabled selected>Select....</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">City</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="city" name="city">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Zip Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="zip" name="zip">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Emergency Contact Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="ecn" name="ecn">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Emergency Contact Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="ecp" name="ecp">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Selected Service</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control form-control-sm" value="{{ $product->service->service }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Selected Procedure</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control form-control-sm" value="{{ $product->procedure->procedure }}">
                        </div>
                    </div>
                    @if (!is_null($product->package))
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">Selected Package</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control form-control-sm" value="{{ $product->package->package}}">
                            </div>
                        </div>
                    @endif
                    <div class="mb-3 row">
                        <div class="col-6">
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-main btn-sm mx-1">Next</button>
                            <button type="submit" class="btn btn-main btn-sm mx-1">Next</button>
                            <button type="button" class="btn btn-main btn-sm mx-1">Cancel</button>
                            <button type="reset" class="d-none">Reset</button>
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
        var globalRouteobtenerEstados = "{{ route('staff.products.configuration.getProcedureList') }}";
    </script>
    <script>
        $(document).ready(function () {

            $(docuemt).on(change, '#countries', function () {
                var country_id = $( "#countries option:selected" ).val();
                getStates(country_id)
            });


            function getCoubtries(country_id) {
                var form_data = new FormData();
                form_data.append('id', country_id);
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
                    },
                    success:function(data)
                    {
                        Toast.fire({
                            icon: data.icon,
                            title: data.msg
                        })
                        if (data.reload) {
                            procedureTable.ajax.reload( null, false );
                        }
                    },
                    complete: function()
                    {
                    },
                })
            }

        });
    </script>

@endsection

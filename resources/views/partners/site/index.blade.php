@extends('partners.layouts.app_site')


@section('content')
@include('site.trans.home')

<main id="main">
    @php
        //$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //$actual_link = "$_SERVER[REQUEST_URI]";

    @endphp

  
    <div class="container">
        <section id="about-us" class="about-us">
            <div class="container">
                
                <div class="row no-gutters">
                    <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start" data-aos="fade-right" style="background: url('http://jlpradosc.com/wp-content/uploads/2020/09/jlprado-img-about-us.jpg') center/cover no-repeat;"></div>
                    <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
                        <div class="content d-flex flex-column justify-content-around p-3">
                            {!! aboutUs('es') !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 my-3">
                    {!! aboutUs2('es') !!}
                </div>
            </div>
        </section>
        <section id="services" class="services section section-bg">
            <div class="container">
                <div class="section-title" data-aos="fade-up">

                </div>
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6 mx-0 px-0">
                       <div id="qbox-container">
                        <form class="needs-validation" id="form-wrapper" method="post" name="form-wrapper" novalidate="">
                            <div id="steps-container">
                                <div class="step">
                                    {{ csrf_field() }}
                                    <div class="mb-2 row">
                                        <div class="col-3"></div>
                                        <div class="col-sm-9">
                                            <p for="staticEmail" class="col-form-label col-form-label-sm text-center">@lang('site/apps.Have you received any treatment with us before?')</p>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm"></label>
                                        <div class="col-sm-9 text-center">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="treatmentBefore" id="treatmentBeforeYes" value="1" @if (old('treatmentBefore') == "1") checked @elseif(!empty($patient ?? '') && $patient->treatmentBefore == '1') checked @endif>
                                                <label class="form-check-label" for="treatmentBeforeYes">@lang('site/apps.Yes')</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="treatmentBefore" id="treatmentBeforeNo" value="0" @if (old('treatmentBefore') == "0") checked @elseif(!empty($patient ?? '') && $patient->treatmentBefore == '0') checked @endif>
                                                <label class="form-check-label" for="treatmentBeforeNo">@lang('site/apps.No')</label>
                                            </div>
                                            <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                <strong></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Email')</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="email" name="email" value="{{ $patient->email ?? old('email') }}" placeholder="email@example.com">
                                           
                                            <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                <strong></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Name')</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $patient->name ?? old('name') }}" placeholder="Name">
                                            
                                            <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                <strong></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div id="data-hidde">
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Biological Sex')</label>
                                            <div class="col-sm-9">
                                                <select name="sex" id="sex" class="form-control form-control-sm">
                                                    <option value="" disabled selected>Select....</option>
                                                    <option value="male" @if (old('sex') == "male") selected @elseif(!empty($patient) && $patient->sex == 'male') selected @endif>Male</option>
                                                    <option value="female" @if (old('sex') == "female") selected @elseif(!empty($patient) && $patient->sex == 'famale') selected @endif>Female</option>

                                                </select>
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Birth Date')</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" id="dob" name="dob" value="{{ $patient->dob ?? old('dob') }}" placeholder="Date of Birth">
                                                
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Age')</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="age" name="age" value="{{ $patient->age ?? old('age') }}" placeholder="Age">
                                                
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Phone')</label>
                                            <div class="col-sm-9">
                                                <input type="phone" class="form-control form-control-sm" id="phone" name="phone" value="{{ $patient->phone ?? old('phone') }}" placeholder="phone">
                                                
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Mobile')</label>
                                            <div class="col-sm-9">
                                                <input type="phone" class="form-control form-control-sm" id="mobile" name="mobile" value="{{ $patient->mobile ?? old('mobile') }}" placeholder="Mobile">
                                                
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Address')</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="address" name="address" value="{{ $patient->address ?? old('address') }}" placeholder="Address">
                                                
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Country')</label>
                                            <div class="col-sm-9">
                                                <select name="country_id" id="country_id" style="width: 100%!important" country="{{ $patient->country_id ?? old('country_id') }}" class="form-control form-control-sm">
                                                   
                                                </select>
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.State ')</label>
                                            <div class="col-sm-9">
                                                <select name="state_id" style="width: 100%!important" state="{{ $patient->state_id ?? old('state_id') }}" id="state_id" class="form-control form-control-sm">
                                                    <option value="" disabled selected>Select....</option>
                                                </select>
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.City')</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="city" name="city" value="{{ $patient->city ?? old('city') }}" placeholder="City">
                                               
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Zip Code')</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="zip" name="zip" value="{{ $patient->zip ?? old('zip') }}" placeholder="Zip">

                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Emergency Contact Name')</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="ecn" name="ecn" value="{{ $patient->ecn ?? old('ecn') }}" placeholder="Emergency Contact Name">

                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Emergency Contact Phone')</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control form-control-sm" id="ecp" name="ecp" value="{{ $patient->ecp ?? old('ecp') }}" placeholder="Emergency Contact Phone">
                                                
                                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong></strong>
                                                </span>
                                                
                                            </div>
                                        </div>
                                        <h3 class="font-weight-bolder">Selecciona el tratamiento que desea cotizar</h3>
                                        <div class="mb-3 row">
                                            <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Selected Service')</label>
                                            <div class="col-sm-9">
                                                <select class="form-control input-height" style="width: 100%!important" name="service" id="choice-service-select"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Selected Procedure')</label>
                                        <div class="col-sm-9">
                                            <select class="form-control input-height form-control-sm" name="procedure" id="choice-procedure-select"></select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row hide-package-div">
                                        <label for="inputPassword" class="col-sm-3 col-form-label col-form-label-sm">@lang('site/apps.Selected Package')</label>
                                        <div class="col-sm-9">
                                            <select class="form-control input-height" name="package" style="width: 100%!important;" id="choice-package-select"></select>
                                        </div>
                                    </div>
                                    <span class="invalid-feedback" id="tratamiento_existe" style="display: block!important;" role="alert">
                                        <strong></strong>
                                    </span>
                                </div>
                                <div class="step">
                                    step 2
                                </div>
                                <div class="step">
                                    step 3
                                </div>
                                <div class="step">
                                    step 4
                                </div>
                                <div class="step">
                                    step 5
                                </div>
                                <div class="step">
                                    step 6
                                </div>
                                <div id="success">
                                    <div class="mt-5">
                                        <h4>Success! We'll get back to you ASAP!</h4>
                                        <p>Meanwhile, clean your hands often, use soap and water, or an alcohol-based hand rub, maintain a safe distance from anyone who is coughing or sneezing and always wear a mask when physical distancing is not possible.</p>
                                        <a class="back-link" href="">Go back from the beginning ➜</a>
                                    </div>
                                </div>
                            </div>
                            <div id="q-box__buttons">
                                <button id="prev-btn" type="button">Previous</button> 
                                <button id="next-btn" type="button">Next</button> 
                                <button id="submit-btn" type="submit">Submit</button>
                            </div>
                        </form>
                       </div>
                    </div>
                    <div class="col-lg--3"></div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection

@section('scripts')
    <script>
        let $data = {
                title: 'New Pirate Captain',
                body: 'Arrrrrr-ent you excited?',
                userId: 3
            }
        

        let step = document.getElementsByClassName('step');
        let prevBtn = document.getElementById('prev-btn');
        let nextBtn = document.getElementById('next-btn');
        let submitBtn = document.getElementById('submit-btn');
        let form = document.getElementsByTagName('form')[0];
        let preloader = document.getElementById('preloader-wrapper');
        let bodyElement = document.querySelector('body');
        let succcessDiv = document.getElementById('success');
        let regex = /^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i;
        let csrf = document.querySelector('meta[name="csrf-token"]').content;
        let globalRouteSearchService = "{{ route('partners.services') }}";
        let globalRouteSearchProcedure = "{{ route('partners.procedures') }}";
        let globalRouteSearchPackage = "{{ route('partners.packages') }}";
        let globalRouteSearchCountry = "{{ route('partners.countries') }}";
        let globalRouteSearchState = "{{ route('partners.states') }}";

        $('.hide-package-div').hide('fast');
        form.onsubmit = () => {
            return false
        }

        let current_step = 0;
        let stepCount = step.length
        succcessDiv.classList.add('d-none')
        for (var i = 0; i < stepCount; i++) {
            step[i].style.display = 'none';
        }

        step[current_step].classList.add('d-block');
        if (current_step == 0) {
            prevBtn.classList.add('d-none');
            submitBtn.classList.add('d-none');
            nextBtn.classList.add('d-inline-block');
            nextBtn.setAttribute('data-step', current_step);
        }
        
        nextBtn.addEventListener('click', () => {
            
            
            $('.invalid-feedback').html('');
            let data_service = 0;
            let data_procedure = 0;
            let data_package = 0;
            let data_sex = '';
            let data_country_id = '';
            let data_state_id = '';
            if ($('#choice-service-select').data('select2')){
                if ($('#choice-service-select').select2('data').length > 0) {data_service = $('#choice-service-select').select2('data')[0].id;}else {data_service = 0;}
            }
            if ($('#choice-procedure-select').data('select2')){
                if ($('#choice-procedure-select').select2('data').length > 0) {data_procedure = $('#choice-procedure-select').select2('data')[0].id;}else {data_procedure = 0;}
            }
            if ($('#choice-package-select').data('select2')){
                if ($('#choice-package-select').select2('data').length > 0) {data_package = $('#choice-package-select').select2('data')[0].id;}else {data_package = 0;}
            }

            if ($('#sex').data('select2')){
                if ($('#sex').select2('data').length > 0) {data_sex = $('#sex').select2('data')[0].id;}else {data_sex = 0;}
            }

            if ($('#country_id').data('select2')){
                if ($('#country_id').select2('data').length > 0) {data_country_id = $('#country_id').select2('data')[0].id;}else {data_country_id = 0;}
            }
            if ($('#state_id').data('select2')){
                if ($('#state_id').select2('data').length > 0) {data_state_id = $('#state_id').select2('data')[0].id;}else {data_state_id = 0;}
            }


           var form_data = new FormData();
           let inputs = step[current_step].getElementsByTagName('input')
           for (var i = 0; i < inputs.length; i++) {
               form_data .append(inputs[i].getAttribute('name'), inputs[i].value)
           }


           form_data.append('procedure_en', 1)
           form_data.append('step', current_step);
           form_data.append('service', data_service);
           form_data.append('package', data_package);
           form_data.append('procedure', data_procedure);
           form_data.append('sex', data_sex);
           form_data.append('country_id', data_country_id);
           form_data.append('state_id', data_state_id);
           $.ajax({
               url: 'http://prado.test/partners/site/32123/validateData',
               method:"POST",
               data: form_data,
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="_token"]').attr('value')
               },
               processData: false,
               dataType:'JSON',
               contentType: false,
               cache: false,
               beforeSend: function()
               {
               },
               success:function(data)
               {
               console.log("data", data);
                    if (data.hasOwnProperty('exist')) {
                        if (!data.exist) {
                            $('#tratamiento_existe').html('<strong>'+data.msg+'</strong>')
                        }
                    }
                    if (data.success) {
                        current_step++
                        let previous_step = current_step - 1;

                       if ((current_step > 0) && (current_step < stepCount)) {

                            prevBtn.classList.remove('d-none');
                            prevBtn.classList.add('d-inline-block');

                            step[current_step].classList.remove('d-none');
                            step[current_step].classList.add('d-block');

                            step[previous_step].classList.remove('d-block');
                            step[previous_step].classList.add('d-none');

                            if (current_step + 1 == stepCount) {
                                nextBtn.classList.remove('d-inline-block');
                                nextBtn.classList.add('d-none');
                                submitBtn.classList.remove('d-none');
                                submitBtn.classList.add('d-inline-block');
                            }
                        }
                    } else {
                        
                        $.each( data.errors, function( key, value ) {
                            $('*[id^='+key+']').parent().find('.invalid-feedback').append('<strong>'+value+'</strong>')
                        });
                    }
                    
               },
               error: function (err)
               {
                   console.log('err', err)
               },
               complete: function()
               {
               },
           })
           
        });


        $('#choice-service-select').empty().attr('placeholder', "Seleccionar ...").trigger('change')
        $('#choice-service-select').select2({
            placeholder: "Seleccionar...",
            ajax: {
                url: globalRouteSearchService,
                type: 'post',
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term,
                    }
                },
                headers: {'X-CSRF-TOKEN': csrf},
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.service_es,
                            };
                        })
                    };
                },
                cache: true,
            }
        })

        $('#choice-service-select').on('select2:select', function(e){
            let data = e.params.data;
            $('#choice-procedure-select').val(null).empty().attr('placeholder', "Seleccionar...").trigger('change');
            $('#choice-package-select').val(null).empty().attr('placeholder', "Seleccionar...").trigger('change');
            getProcedure(data.id)
        });

        function getProcedure(id){
            $('#choice-procedure-select').select2({
                placeholder: 'Seleccionar...',
                ajax: {
                url: globalRouteSearchProcedure,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            key: params.term,
                            service: id,
                        }
                    },
                    headers: {'X-CSRF-TOKEN': csrf},
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.procedure,
                                    package: obj.package,
                                };
                            })
                        };
                    },
                    cache: true,
                }
            })
        }
        $('#choice-procedure-select').on('select2:select', function(e){
            let data = e.params.data;
            if (data.package == 1) {$('.hide-package-div').show('fast')} else {$('.hide-package-div').hide('fast')}
            getPackage(data.id)
        })

        function getPackage(id){
            $('#choice-package-select').val(null).empty().attr('placeholder', "Seleccionar").trigger('change');
            $('#choice-package-select').select2({
                placeholder: 'Select...',
                ajax: {
                url: globalRouteSearchPackage,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            key: params.term,
                            procedure: id,
                        }
                    },
                    headers: {'X-CSRF-TOKEN': csrf},
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.package,
                                };
                            })
                        };
                    },
                    cache: true,
                }
            })
        }

        $("#sex").select2({placeholder: "Seleccionar..."})

        $('#country_id').empty().attr('placeholder', "Seleccionar ...").trigger('change')
        $('#country_id').select2({
            placeholder: "Seleccionar...",
            ajax: {
                url: globalRouteSearchCountry,
                type: 'post',
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term,
                    }
                },
                headers: {'X-CSRF-TOKEN': csrf},
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name,
                            };
                        })
                    };
                },
                cache: true,
            }
        })

        $('#country_id').on('select2:select', function(e){
            let data = e.params.data;
            getStates(data.id)
        })

        function  getStates(id){
            $('#state_id').val(null).empty().attr('placeholder', "Seleccionar").trigger('change');
            $('#state_id').select2({
                placeholder: 'Select...',
                ajax: {
                url: globalRouteSearchState,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            key: params.term,
                            country: id,
                        }
                    },
                    headers: {'X-CSRF-TOKEN': csrf},
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.name,
                                };
                            })
                        };
                    },
                    cache: true,
                }
            })
        }


        window.addEventListener('message', event => {
            // IMPORTANT: check the origin of the data!
            if (event.origin.startsWith('http://byteoncloud.test')) {
                // The data was sent from your site.
                // Data sent with postMessage is stored in event.data:
                console.log(event.data);
            } else {
                // The data was NOT sent from your site!
                // Be careful! Do not use it. This else branch is
                // here just for clarity, you usually shouldn't need it.
                return;
            }
        });
    </script>
@endsection
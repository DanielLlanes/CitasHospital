@inject('DatesLangTrait', 'App\Traits\DatesLangTraitForBlade')
@inject('StatusAppsTrait', 'App\Traits\StatusAppsTraitForBlade')

@extends('staff.layouts.app')
@section('title')
	@lang('Application Details')
@endsection
@section('content')

@php

    $arrays = [];
    $arraysDos = [];
    foreach($appInfo->treatment->service->specialties as $object){$arrays[] = $object->toArray();}
    foreach($appInfo->assignments as $object){$arraysDos[] = $object->toArray();}


    for ($i = 0; $i < count($arrays); $i++) {
        unset($arrays[$i]['pivot']);
    }

    for ($i = 0; $i < count($arraysDos); $i++) {
        $arraysDos[$i]['ass'] = $arraysDos[$i]['pivot']['ass_as'];
        $arraysDos[$i]['staff_id'] = $arraysDos[$i]['id'];
        unset($arraysDos[$i]['pivot']);
        unset($arraysDos[$i]['specialties']);
    }


    $ass = array_column($arraysDos, 'name', 'ass');
    $otro = array_column($arraysDos, 'id', 'ass');
    $ass_as = array_column($arraysDos, 'ass', 'ass');

    

    array_walk($arrays, function(&$staff) use ($ass, $otro, $ass_as) {
        $id = $staff['id'];
        $staff['name'] = isset($ass[$id]) ? $ass[$id] : null;
        $staff['staff_id'] = isset($otro[$id]) ? $otro[$id] : null;
        $staff['ass_as'] = isset($ass_as[$id]) ? $ass_as[$id] : null;
    });



@endphp
<a href=""></a>
<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Detalles de la aplicaión</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">Inicio</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Listado de aplicaciones</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Detalles de la aplicaión</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <div class="card card-topline-aqua">
                <div class="card-body no-padding height-9">
                    <div class="row">
                        <div class="profile-userpic">
                            <img src="{{ asset('staffFiles/assets/img/user/user.jpg') }}" class="img-responsive" alt="">
                        </div>
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-job"> Patient </div>
                        <div><span class="profile-usertitle-name">{{ $appInfo->patient->name ?? '' }} </span></div>
                        <div id="biography" >
                            <div class="row">
                                <div class="col-12 mb-2"> <strong>Edad</strong>
                                    <br>
                                    <p class="text-muted">{{ $appInfo->patient->age ?? ''}}</p>
                                </div>
                                <div class="col-12 mb-2"> <strong>Fecha de Nacimiento</strong>
                                    <br>
                                    @if (!is_null($appInfo->patient->dob))
                                        <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->patient->dob)->toFormattedDateString() }}</p>
                                    @endif
                                </div>
                                <div class="col-12 mb-2"> <strong>Género</strong>
                                    <br>
                                    <p class="text-muted">{{ $appInfo->patient->sex }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-2 text-center" id="current-status-area-div"> <strong>Current Status</strong>
                                    <br>
                                    <p id="current-status-p">{!!  getStatus($appInfo->statusOne->status->name, $appInfo->statusOne->status->color) !!}</p>
                                </div>
                                    
                                    
                                        <div class="col-12 mb-2 text-center" id="set-status-area-div"> <strong>Set Status</strong>
                                            <br>
                                            <div class="d-flex justify-content-between">
                                                @if ($thisUserCanApproval && $appInfo->statusOne->status->id == 9 || $appInfo->statusOne->status->id == 1)
                                                    <button id="status-accepted-button" class="btn btn-success">accepted</button>
                                                    <button id="status-declined-button" class="btn btn-danger">Declined</button>
                                                @elseif(Auth::guard('staff')->user()->hasRole(['dios', 'super-administrator', 'administrator']))
                                                    <button id="status-accepted-button" class="btn {{ $appInfo->statusOne->status->id == 9 || $appInfo->statusOne->status->id == 1 ? 'btn-success' : 'btn-warning' }} btn-success">accepted</button>
                                                    <button id="status-declined-button" class="btn btn-danger">Declined</button>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="profile-tab-box">
                    <div class="p-l-20">
                        <ul class="nav ">
                            @can('patients.details')
                                <li class="nav-item tab-all">
                                    <a class="nav-link active show" href="#patientData" data-toggle="tab">Datos del paciente</a>
                                </li>
                            @endcan
                            {{-- @can('applications.details') --}}
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link {{ (!Auth::guard('staff')->user()->can('patients.details')) ? "active show": ""}}" href="#services" data-toggle="tab">Servicios</a>
                                </li>
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#healthData" data-toggle="tab">Datos de salud</a>
                                </li>
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#surgeries" data-toggle="tab">Cirugías</a>
                                </li>
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#medicalHistory" data-toggle="tab">Historial médico</a>
                                </li>
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#generalHealthData" data-toggle="tab">Datos generales de salud</a>
                                </li>
                                @if ($appInfo->patient->sex != "male")
                                    <li class="nav-item tab-all p-l-20">
                                        <a class="nav-link" href="#ghynecologicaldata" data-toggle="tab">Datos ginecológicos</a>
                                    </li>
                                @endif
                            {{-- @endcan --}}
                            @can('applications.debate')
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#debateChat" data-toggle="tab">Debate</a>
                                </li>
                            @endcan
                            @can('applications.timeline')
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#timeLine" data-toggle="tab">Linea de tiempo </a>
                                </li>
                            @endcan
                            @can('applications.logisticnotes')
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#logisticsNotes" data-toggle="tab">Notas de logística</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>
                <div class="white-box">
                            <!-- Tab panes -->
                    <div class="tab-content">
                        @can('patients.details')
                            <div class="tab-pane active fontawesome-demo" id="patientData">
                                <div id="biography" >
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Nombre completo</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->name ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Email</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->email ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Teléfono</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->phone ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Móvil</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->mobile ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Edad</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->age }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Fecha de nacimiento</strong>
                                            <br>
                                            @if (!is_null($appInfo->patient->dob))
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->patient->dob)->toFormattedDateString() }}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Género</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->sex ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Dirección</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->address ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>País</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->pais ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Estado</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->estado ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Ciudad</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->city ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Código postal</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->zip ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Contacto de emergencia</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->ecn ?? '' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Teléfono contacto de emergencia</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->patient->ecp ?? '' }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        @endcan
                        {{-- @can('applications.details') --}}
                            <div class="tab-pane fontawesome-demo {{ (!Auth::guard('staff')->user()->can('patients.details')) ? "active ": ""}}" id="services">
                                <div id="biography">
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Marca</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->treatment->brand->brand }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Servicio</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->treatment->service->service }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Procedimiento</strong>
                                            <br>
                                            <p class="text-muted" code="{{ $appInfo->treatment->procedure->code }}" procedure_id="{{ $appInfo->treatment->procedure->id }}" id="change-procedure-p">{{ $appInfo->treatment->procedure->procedure }}</p>
                                                @if ($appInfo->statusOne->status->id == 5 && !is_null($appInfo->recommended_id))
                                                @endif
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Paquete</strong>
                                            <br>
                                            <p class="text-muted" code="{{ $appInfo->treatment->package->code ?? '' }}" id="change-package-p" package_id="{{ $appInfo->treatment->package->id ?? '' }}">
                                                {!! (is_null($appInfo->treatment->package) ? " ----- ": $appInfo->treatment->package->package) !!}
                                                @if (!is_null($appInfo->treatment->package))
                                                    <p><button id="change-package-button" class="btn btn-warning btn-sm">Change</button></p>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row" id="recommended-procedure-row">
                                        @if (!is_null($appInfo->recommended_id) && !is_null($appInfo->recommended_id))
                                            @if (Auth::guard('staff')->user()->hasRole(['dios', 'super-administrator', 'administrator', 'coordinator']))
                                                <div class="col-12"> 
                                                    <strong>Procedimiento sugerido: 
                                                        <br>
                                                        <span>{{ $appInfo->recommended->procedure }}</span>
                                                    </strong>
                                                    <div class="packageDosentExist" id="packageDosentExist" style="@if ($exist) display: none; @endif">
                                                        <br>
                                                        <div class="alert alert-danger " role="alert">
                                                            El paquete del procedimiento requerido es <strong class="oldPackage"> {!! (is_null($appInfo->treatment->package) ? " ----- ": $appInfo->treatment->package->package) !!}</strong>. 
                                                            <br>
                                                            Y no se encuentra disponible en el nuevo procedimiento: <strong>{{ $appInfo->recommended->procedure }}</strong>
                                                            <br>
                                                            por favor informe al Paciente sobre el nuevo procedimiento y nuevo paquete 
                                                            <br>
                                                            los Paquetes disponibles para <strong>{{ $appInfo->recommended->procedure }}</strong> son:
                                                            <ul class="availablePackahesList">
                                                                @for ($i = 0; $i < count($packsDsponibles); $i++)
                                                                    <li>
                                                                        <strong>{{ $packsDsponibles[$i]['package'] }}</strong>
                                                                    </li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                <br>
                                                    <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="recommended-procedure-checkbox">
                                                    <label class="form-check-label" for="recommended-procedure-checkbox" id="recommended-procedure-span">El paciente acepta el cambio? </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                        @if (count($sugerencias) > 0 && $appInfo->statusOne->status->id == 15)
                                            @if (Auth::guard('staff')->user()->hasRole(['dios', 'super-administrator', 'administrator', 'coordinator']))
                                            <div class="col-12">
                                                <div class="suggestionsDosentExist" id="suggestionsDosentExist" style="@if (count($sugerencias) < 0) display: none; @endif">
                                                    <div class="alert alert-danger " role="alert">
                                                        <p>El doctor <strong>{{ $sugerencias[0]['staff'] }}</strong> a sugerido otros procedimientos,</p>   

                                                            <p>los procedimientos sugeridos son:</p>

                                                            <ul class="availableSuggestionsList">
                                                                @foreach ($sugerencias as $s)
                                                                    <li>
                                                                        <strong>{{ $s['name'] }}</strong>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <br>
                                                            <p>por favor espere a que administracion realiza una cotización é informe al paciente sobre los nuevos procedimientos</p> 
                                                            <br>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-group form-check mb-auto">
                                                        <input type="checkbox" class="form-check-input" id="suggestion-procedure-checkbox">
                                                        <label class="form-check-label" for="suggestion-procedure-checkbox" id="recommended-procedure-span">El paciente acepta la cotización?* </label>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-12 col-md-8 mb-2 b-r">

                                        <strong>Comentarios del doctor:</strong>
                                        <br>
                                        <span id="span-status-name">{!! getStatus($appInfo->statusOne->status->name, $appInfo->statusOne->status->color) !!}</span>
                                        <div class="form-group">
                                            <h4 class="font-weight-bold mb-0 pb-0" id="h-recomendatons-indications">Indicaciones</h4>
                                            <span id="s-recomendatons-indications">{!!  $appInfo->statusOne->indications ?? '' !!}</span>

                                           <h4 class="font-weight-bold mb-0 pb-0" id="h-recomendatons-recomendation">Recomendaciones</h4>
                                           <span id="s-recomendatons-recomendations">{!! $appInfo->statusOne->recomendations  ?? '' !!}</span>


                                           <h4 class="font-weight-bold mb-0 pb-0" id="h-recomendatons-reazon">Razón</h4>
                                           <span id="s-recomendatons-reazon">{!!  $appInfo->statusOne->reason ?? '' !!}</span>

                                         </div>
                                    </div>
                                    
                                    @if (count($appInfo->imageMany) > 0)
                                        Área de imágenes
                                        <div class="row" id="imageRow">
                                            @foreach ($appInfo->imageMany as $image)
                                                <div class="col-12 col-md-4 col-lg-3">
                                                    <div class="card">
                                                        <a href="{{ asset($image->image) }}" title="{{ $image->title }}" data-effect="mfp-zoom-in" class="a">
                                                            <img src="{{ asset($image->image) }}" class="img-thumbnail" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <hr>
                                    <div class="row mt-5">
                                        <div class="col-12 mb-2 b-r text-center">
                                            <strong>
                                                Personal asignado
                                            </strong>
                                        </div>

                                       @foreach ($arrays as $value)
                                        <div class="col-lg-3 col-12 mb-2 b-r text-center mb-5 mb-lg-0">
                                            <strong>
                                                {{ $value['specialty'] }}
                                            </strong>

                                            <p class="text-muted" id="nameStaff{{ str_replace(" ", "_", (string)$value['specialty']) }}">{!! is_null($value['name']) ? "<br>": $value['name'] !!}
                                            </p>
                                            @if ($value['id'] == 10)
                                                @if (Auth::guard('staff')->user()->can('applications.changeCoordinator'))
                                                    <button type="button" id="appChange{{ $value['specialty'] }}" service="{{ $appInfo->id }}" class="btn btn-success">
                                                        Assing / Change {{ $value['specialty'] }}
                                                    </button>
                                                @endif
                                            @else
                                                @if (Auth::guard('staff')->user()->can('applications.changeStaff'))
                                                    <button type="button" id="appChange{{ str_replace(" ", "_", (string)$value['specialty']) }}" service="{{ $appInfo->id }}" class="btn btn-success">
                                                        Assing / Change {{ $value['specialty'] }}
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                        <br>

                                       @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="healthData">
                                <div id="biography">
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Siatema metrico</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->mesure_sistem == 'I') ? 'Imperial': 'Metric' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Peso máximo {{ ($appInfo->mesure_sistem == 'I') ? '(Lb)': '(Kg)' }}</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->max_weigh }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Peso actual {{ ($appInfo->mesure_sistem == 'I') ? '(Lb)': '(Kg)' }}</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->weight }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Altura {{ ($appInfo->mesure_sistem == 'I') ? '(Ft)': '(Mts)' }}</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->height }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>IMC</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->imc }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Medicamentos / Drogas</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->if_take_medication == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Anticoagulantes</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->if_take_blood_thinners == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->if_take_blood_thinners == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>Explica la razón</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->razon_blood_thinners }}</p>
                                            </div>
                                        @endif
                                        @if (count($appInfo->medications) > 0)
                                            <div class="col-md-12"> <strong>Medicamentos</strong>
                                                <br>
                                                <div class="table-wrap">
                                                    <div class="table-responsive">
                                                        <table class="table display treatment-overview mb-30" id="support_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nomnre</th>
                                                                    <th>Razón</th>
                                                                    <th>Dosis</th>
                                                                    <th>Frecuencia</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($appInfo->medications as $key => $item)
                                                                    <tr>
                                                                        <td>{{ ($key+1) }}</td>
                                                                        <td><span class="label label-sm label-danger">{{ $item->name }}</span></td>
                                                                        <td>{{ $item->reason }}</td>
                                                                        <td>{{ $item->dosage }}</td>
                                                                        <td>{{ $item->frecuency }}</td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-3 col-6 mb-2"> <strong>Reflujo ácido?</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->acid_reflux }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Alergia a la penicilina</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->penicilin == 0)? 'No':'Yes' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Drogas sulfa</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->drugs_sulfa == 0)? 'No':'Yes' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Alergia al yodo</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->iodine == 0)? 'No':'Yes' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Alergia al latex</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->latex == 0)? 'No':'Yes' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Alergia a la cinta</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->tape == 0)? 'No':'Yes' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Alergia a la aspirina</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->aspirin == 0)? 'No':'Yes' }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Otras alergias</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->other_allergy == 0)? 'No':'Yes' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="surgeries">
                                <div id="biography">
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Cirugías</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->if_have_surgeries == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if (count($appInfo->surgeries) > 0)
                                            <div class="col-md-12"> <strong>Cirugías</strong>
                                                <br>
                                                <div class="table-wrap">
                                                    <div class="table-responsive">
                                                        <table class="table display treatment-overview mb-30" id="support_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Tipo</th>
                                                                    <th>Nomnre</th>
                                                                    <th>Edad</th>
                                                                    <th>Año</th>
                                                                    <th>Complicaciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($appInfo->surgeries as $key => $item)
                                                                    <tr>
                                                                        <td>{{ ($key+1) }}</td>
                                                                        <td><span class="label label-sm label-danger">{{ $item->type }}</span></td>
                                                                        <td>{{ $item->name }}</td>
                                                                        <td>{{ $item->age }}</td>
                                                                        <td>{{ $item->year }}</td>
                                                                        <td>{{ $item->complications }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="medicalHistory">
                                <div id="biography">
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Adicciones</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->addiction == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->addiction == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>Cuál</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->which_one_adiction}}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 mb-2"> <strong>Niveles altos de lípidos</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->high_lipid_levels == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->high_lipid_levels == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_high_lipd_levels)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->high_lipid_levels_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Artritis</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->arthritis == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->arthritis == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_arthritis)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->arthritis_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Cancer</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->cancer == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->cancer == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_cancer)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->cancer_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Colesterol</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->cholesterol == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->cholesterol == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_cholesterol)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->cholesterol_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Triglicéridos</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->triglycerides == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->triglycerides == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_triglycerides)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->triglycerides_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Apoplejía</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->disease_stroke == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->disease_stroke == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_stroke)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->disease_stroke_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diabetes</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->diabetes == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->diabetes == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_diabetes)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->diabetes_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Enfermedad arterial coronaria</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->coronary_artery_disease == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->coronary_artery_disease == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_coronary_artery_disease)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->coronary_artery_disease_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Enfermedades del hígado</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->disease_liver == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->disease_liver == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_liver)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->disease_liver_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Enfermedad pulmonar</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->disease_lung == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->disease_lung == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_lungs)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->disease_lung_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Enfermedad renal</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->disease_renal == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->disease_renal == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_renal)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->disease_renal_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Enfermedad de tiroides</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->disease_thyroid == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->disease_thyroid == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_thyroid)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->disease_thyroid_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Hipertensión</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->ypertension == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->ypertension == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Fecha de diagnóstico</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_hypertension)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->hypertension_treatment }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-4 col-6 mb-2"> <strong>Cualquier otra enfermedad</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->disease_other == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if (count($appInfo->illnessess) > 0)
                                            <div class="col-md-12"> <strong>Illnessess</strong>
                                                <br>
                                                <div class="table-wrap">
                                                    <div class="table-responsive">
                                                        <table class="table display treatment-overview mb-30" id="support_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Enfermedad</th>
                                                                    <th>Fecha de diagnóstico</th>
                                                                    <th>Tratamiento</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($appInfo->illnessess as $key => $item)
                                                                    <tr>
                                                                        <td>{{ ($key+1) }}</td>
                                                                        <td><span class="label label-sm label-danger">{{ $item->illness}}</span></td>
                                                                        <td>{{ Carbon\Carbon::parse($item->diagnostic_date)->toFormattedDateString() }}</td>
                                                                        <td>{{ $item->treatment }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="generalHealthData">
                                <div id="biography">
                                    <div class="row">
                                        <div class="col-md-4 col-6 mb-2"> <strong>Fumar cigarrillos</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->smoke == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->smoke == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Cantidad</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->smoke_cigars }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Tratamiento</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->smoke_years }}</p>
                                            </div>
                                        @endif
                                        @if ($appInfo->smoke == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Dejo de fumar</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->stop_smoking == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->stop_smoking == 1)
                                                <div class="col-md-4 col-6 mb-2"> <strong>Desde cuándo</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->smoke_years }}</p>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 mb-2"> <strong>Vape</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->vape == 0)? "No":"Yes" }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 mb-2"> <strong>Bebe alcohol</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->alcohol == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->alcohol == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>Volumen de alcohol (frecuencia)</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->volumen_alcohol }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Usa drogas recreativas?</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->recreative_drugs == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->recreative_drugs == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>Cantidad de medicamentos (píldoras)</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->total_recreative_drugs }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Use drogas intravenosas</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->intravenous_drugs == 0)? "No":"Yes" }}</p>
                                            </div>
                                        @endif
                                        @if ($appInfo->intravenous_drugs == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>Descripción de drogas intravenosas.</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->description_intravenous_drugs }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Fácilmente fatigado</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->fatigue == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Dificultad para respirar</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->trouble_breathe == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Asma</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->asthma == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Usa un B-PAP o C-PAP mientras duerme</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->bipap_cpap == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Ejercicio</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->exercise == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->exercise == 1)
                                            <div class="col-md-12"> <strong>Ejercicio</strong>
                                                <br>
                                                <div class="table-wrap">
                                                    <div class="table-responsive">
                                                        <table class="table display treatment-overview mb-30" id="support_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>tipo</th>
                                                                    <th>Desde cuándo</th>
                                                                    <th>Frecuencia</th>
                                                                    <th>Horas por día</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($appInfo->exercices as $key => $item)
                                                                    <tr>
                                                                        <td>{{ ($key+1) }}</td>
                                                                        <td><span class="label label-sm label-danger">{{ $item->type}}</span></td>
                                                                        <td>{{ $item->how_long }}</td>
                                                                        <td>{{ $item->how_frecuency }}</td>
                                                                        <td>{{ $item->Hours_per_day }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($appInfo->treatment->service_id == 3)
                                            <div class="col-md-3 col-6 mb-2"> <strong>Horas que duerme por la noche</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->hours_you_sleep_at_night }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Tomar pastillas para dormir</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->do_you_take_sleeping_pills == 0)? "No":"Yes" }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Sufre de ansiedad o depresión.</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->do_you_suffer_from_anxiety_or_depression == 0)? "No":"Yes" }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Toma pastillas para la ansiedad o la depresión.</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->do_you_take_pills_for_anxiety_or_depression == 0)? "No":"Yes" }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Se siente estresado</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->exercise == 0)? "No":"Yes" }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($appInfo->treatment->service_id == 3 && $appInfo->patient->sex == "male")
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2"> <strong>Tiene erecciones por la mañana</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->do_you_have_erections_at_the_morning == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->do_you_have_erections_at_the_morning == 1)
                                                <div class="col-md-3 col-6 mb-2"> <strong>Cuantas por semana</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->how_many_per_week }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2"> <strong>Tiene problemas para tener una erección.</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->do_you_have_erections_at_the_morning == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->do_you_have_erections_at_the_morning == 1)
                                                <div class="col-md-3 col-6 mb-2"> <strong>Desde cuando</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->since_when }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>Describa</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->describe_your_erection_problem }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2"> <strong>Tiene problemas para mantener una erección</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->do_you_have_problems_maintaining_an_erection == 0)? "No":"Yes" }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2"> <strong>Toma cualquier remedio natural para la disfunción eréctil</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->do_you_take_any_natural_remedy_for_erectile_dysfunction == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->do_you_take_any_natural_remedy_for_erectile_dysfunction == 1)
                                                <div class="col-md-3 col-6 mb-2"> <strong>Que tipo</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->what_kind }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>Funcionarón</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->how_did_it_work_natural_remedy }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>De donde los saco</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->where_did_you_get_them }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2"> <strong>Se han inyectado medicamentos para la disfunción eréctil</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->has_medication_been_injected_for_dysfunction_erectile == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->has_medication_been_injected_for_dysfunction_erectile == 1)
                                                <div class="col-md-3 col-6 mb-2"> <strong>Cuantas veces</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->how_many_times_have_injected }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>Funciono?</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->how_did_it_work }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2"> <strong>Ha tenido una erección de más de 6 horas.</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->have_you_had_an_erection_longer_than_six_hours == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->have_you_had_an_erection_longer_than_six_hours == 1)
                                                <div class="col-md-3 col-6 mb-2"> <strong>Cuando</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->when_you_had_a_six_hours_erection }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>Como se resolvió</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->how_was_it_resolved }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>Recibio atención médica</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->did_you_get_medical_attention }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2"> <strong>Sufre de curvatura del pene</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->do_you_suffer_from_penile_curvature == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->do_you_suffer_from_penile_curvature == 1)
                                                <div class="col-md-3 col-6 mb-2"> <strong>How intense</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->how_intense }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>Que dirección</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->which_direction }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>Dolio</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->does_it_hurt }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2"> <strong>¿Previene las relaciones sexuales?</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->does_it_prevent_intercourse }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-6 mb-2"> <strong>Se ha inyectado PRP para la disfunción eréctil</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->has_prp_been_injected_for_erectile_dysfunction == 0)? "No":"Yes" }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Ha recibido tratamiento con células madre para la disfunción eréctil</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->have_you_received_stem_cell_treatment_for_erectile_dysfunction == 0)? "No":"Yes" }}</p>
                                            </div>
                                            <div class="col-md-4 col-6 mb-2"> <strong>Ha recibido terapia de regeneración vascular con terapia de ondas de baja intensidad para la disfunción eréctil?</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->hyrvrntwliwtfed == 0)? "No":"Yes" }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if ($appInfo->patient->sex != "male")
                                <div class="tab-pane fontawesome-demo" id="ghynecologicaldata">
                                    <div id="biography">
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2 b-r"> <strong>Fecha de la última menstruación</strong>
                                                <br>
                                                <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->last_menstrual_period)->toFormattedDateString() }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2 b-r"> <strong>El sangrado fue</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->bleeding_whas }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2 b-r"> <strong>Ha estado embarazada</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->have_you_been_pregnant == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->have_you_been_pregnant == 1)
                                                <div class="col-md-3 col-6 mb-2 b-r"> <strong>Cuántas veces</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->how_many_times }}</p>
                                                </div>
                                                <div class="col-md-3 col-6 mb-2 b-r"> <strong>Cesárea</strong>
                                                    <br>
                                                    <p class="text-muted">{{ $appInfo->c_section }}</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-6 mb-2 b-r"> <strong>Use cualquier tipo de anticonceptivo</strong>
                                                <br>
                                                <p class="text-muted">{{ ($appInfo->birth_control == 0)? "No":"Yes" }}</p>
                                            </div>
                                            @if ($appInfo->birth_control == 1)
                                                <div class="col-md-12"> <strong>Control de la natalidad</strong>
                                                    <br>
                                                    <div class="table-wrap">
                                                        <div class="table-responsive">
                                                            <table class="table display treatment-overview mb-30" id="support_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>tipe</th>
                                                                        <th>Cuánto tiempo</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($appInfo->birthcontrol as $key => $item)
                                                                        <tr>
                                                                            <td>{{ ($key+1) }}</td>
                                                                            <td><span class="label label-sm label-danger">{{ $item->type}}</span></td>
                                                                            <td>{{ $item->how_along_time }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="tab-pane fontawesome-demo" id="debateChat">
                                <div id="biography">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-box">
                                                <div class="card-head">
                                                    <h2 id="para1"></h2>
                                                    <h4 id="para2"></h4>
                                                    <h3 id="para3"></h3>
                                                    <header>Personal</header>
                                                </div>
                                                <div class="card-body no-padding height-9" id="listChat">
                                                    <div class="">
                                                        <ul class="list-unstyled" id="debate_memeber_list">
                                                            @foreach ($debateMembers as $member)
                                                                @if ($member->memeber_show)
                                                                    <li>
                                                                        <strong>
                                                                            <i class="user-conected-{{ $member->member_id }} user-status-icon fa fa-circle" id="{{ $member->member_id }}"></i> {{ $member->member_name }}
                                                                        </strong>
                                                                        <small class="small ml-auto">
                                                                            {{ $member->member_specialty}}
                                                                        </small>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card card-box">
                                                <div class="card-head">
                                                    <header>DEBATE</header>
                                                </div>
                                                <div class="card-body no-padding height-9">
                                                    <div class="row" id="chatRow">
                                                        <ul class="chat nice-chat" id="chatDiv">
                                                            @if (count($appInfo->debates))
                                                                @foreach ($appInfo->debates as $debate)
                                                                    @if ($debate->application_id == $appInfo->id)
                                                                        <li class="{{ ($debate->staff_id == auth()->guard('staff')->user()->id)? "out":"in" }}" id="li-message-{{ $debate->id }}">
                                                                            <img src="{{ asset( getAvatar($debate->staffDebate) )}}" class="avatar" alt="">
                                                                            <div class="message">
                                                                                <span class="arrow"></span>
                                                                                <a class="name" href="#">{{ $debate->staffDebate->name }}</a>
                                                                                <span class="datetime">at {{ $DatesLangTrait->datesLangTrait($debate->created_at, $debate->staffDebate->lang) }}, {{ $debate->created_at->format('g:i A') }}</span>
                                                                                <span class="body">{!! $debate->message !!}</span>
                                                                            </div>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="box-footer chat-box-submit">
                                                        <div class="input-groupx">
                                                            <textarea name="career_objective" class="summernote-messageInput career_objective" id="messageInput" style="width: 100%;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="timeLine">
                                <div id="biography">
                                    <div class="row">
                                        <div class="full-width p-l-20">
                                            <div class="panel">
                                                <form>
                                                    <textarea class="form-control p-text-area" id="post-area-timeline" rows="4" placeholder="Add time line notes"></textarea>
                                                </form>
                                            </div>
                                            <div class="full-width">
                                                <ul class="activity-list post-timeline-view">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fontawesome-demo" id="logisticsNotes">
                                <div id="biography">
                                    <div class="row">
                                        <div class="full-width p-l-20">
                                            <div class="panel">
                                                <form>
                                                    <textarea class="form-control p-text-area" id="post-area-logistic" rows="4" placeholder="Add time line notes"></textarea>
                                                </form>
                                            </div>
                                            <div class="full-width">
                                                <ul class="activity-list post-logistic-view">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {{-- @endcan --}}
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
@php
    foreach ($arrays as $value) {
        if ($value['id'] == 10) {
            if (Auth::guard('staff')->user()->can('applications.changeCoordinator')) {
                echo '<div class="modal fade" id="change'.str_replace(" ", "_", (string)$value['specialty']).'App" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Assing or set '.$value['specialty'].' staff</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="control-label col-md-12">Select '.$value['specialty'].'
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-12">
                                        <select class="form-control input-height" id="getStaff'.str_replace(" ", "_", (string)$value['specialty']).'">
                                        </select>
                                        <span class="help-block text-danger">  </span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        } elseif(Auth::guard('staff')->user()->can('applications.changeStaff')){
            echo '<div class="modal fade" id="change'.str_replace(" ", "_", (string)$value['specialty']).'App" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Assing or set '.$value['specialty'].' staff</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="control-label col-md-12">Select '.$value['specialty'].'
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-12">
                                    <select class="form-control input-height" id="getStaff'.str_replace(" ", "_", (string)$value['specialty']).'">
                                    </select>
                                    <span class="help-block text-danger">  </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
@endphp

<div class="modal fade" id="change-procedure-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Procedures</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="control-label col-md-12">Select Procedure
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-12">
                        <select class="form-control input-height" id="change-procedure-select">
                        </select>
                        <span class="help-block text-danger">  </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm-change-procedure-button">Change</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="change-package-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Packages</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="control-label col-md-12">Select Package
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-12">
                        <select class="form-control input-height" id="change-package-select">
                        </select>
                        <span class="help-block text-danger">  </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm-change-package-button">Change</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="status-accepted-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Application accepted</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center" style="align-content: center">
                    @foreach ($statusOptions as $item)
                    @if ($appInfo['treatment']['service_id'] == 2 )
                        <button class="data-status-select mb-2 mr-2 ml-3 text-white" style="background-color: {{ $item['color'] }}; border-color: {{ $item['color'] }}" status="{{ $item['id'] }}" code="{{ $item['code'] }}" class="btn btn-success">{{ $item['name'] }}</button>
                    @elseif ($appInfo['treatment']['service_id'] != 2 && $item['id'] != 16)
                    {{-- <button class="data-status-select mb-2 mr-2 ml-3 text-white" style="background-color: {{ $item['color'] }}; border-color: {{ $item['color'] }}" status="{{ $item['id'] }}" code="{{ $item['code'] }}" class="btn btn-success">{{ $item['name'] }}</button> --}}
                    @endif
                    @endforeach
                </div>
                <div class="text-center">
                    <p class="d-blok m-0">Procedimiento: </p>
                    <p class="d-blok m-0"><strong> {{ $appInfo->treatment->procedure->procedure }}</strong></p>
                </div>
                <div class="form-group row" data-id="5">
                    <label class="control-label col-md-12">Medical recommendations
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-12">
                        <textarea name="medicalRecommendations" id="medicalRecommendations" class="summernote" cols="30" rows="10"></textarea>
                        <span class="help-block text-danger">  </span>
                    </div>
                    <label class="control-label col-md-12 mt-5">Medical indications
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-12">
                        <textarea name="medicalIndications" id="medicalIndications" class="summernote" cols="30" rows="10"></textarea>
                        <span class="help-block text-danger">  </span>
                    </div>
                </div>
                <div class="form-group row step d-none" data-id="13">
                    <label class="control-label col-md-12">The patient has been approved for
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-12">
                        <select class="form-control input-height" id="accepted-status-select">
                        </select>
                        <span class="help-block text-danger">  </span>
                    </div>
                </div>
                <div class="form-group row step d-none" data-id="16">
                    <label class="control-label col-md-12">Add suggestions
                        <span class="required"> * </span>
                    </label>
                    <div class="col-12">
                        <div class="row cbSugerencias">
                             @foreach ($proceduresList as $it)
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" nombre="{{ $it->nombre }}" class="custom-control-input"  id="procedure-{{ $it->id }}" value="{{ $it->id }}">
                                        <label class="custom-control-label" for="procedure-{{ $it->id }}">{{ $it->nombre }}</label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12">
                                <div id="sugerenciasArray">
                                    <span class="help-block text-danger">  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" action="{{ $statusOptions[0]['id'] }}" codigo="{{ $statusOptions[0]['code'] }}" id="confirm-status-accepted-button">
                    Change 
                    <div class="spinner-border text-warning d-none btn-status-acept" role="status" style="width: 1rem; height: 1rem">
                        <span class="sr-only">Loading...</span>
                      </div>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="status-declined-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Declined application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="control-label col-md-12">Reason
                        <span class="required"> * </span>
                    </label>
                    <div class="col-md-12">
                        <textarea name="declined-app" id="declined-app" class="summernote" cols="30" rows="10"></textarea>
                        <span class="help-block text-danger">  </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm-status-declined-button">Change</button>
            </div>
        </div>
    </div>
</div>
<div id="timeline-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" id="scroll">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar notas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="timeline-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Add time line notes:</label>
                        <textarea class="form-control p-text-area post-area-timeline" id="post-area-timeline" rows="4" placeholder="Add time line notes"></textarea>
                    </div>
                    <style>
                        #imagen-dropyfy {
                            border-radius: 10px;
                            width: 100%;
                            min-height: 250px;
                            height: auto;
                            border: .5px solid;
                            border-color: #eee;
                            position: relative;
                            overflow-y: auto;
                            overflow-x: hidden;
                        }
                        #images-input {
                            display: none;
                        }
                        #images-input::-webkit-file-upload-button {
                        visibility: hidden;
                        }
                        #images-input::before {
                        content: 'Select some files';
                        color: black;
                        display: inline-block;
                        background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
                        border: 1px solid #999;
                        border-radius: 3px;
                        padding: 5px 8px;
                        outline: none;
                        white-space: nowrap;
                        /* -webkit-user-select: none; */
                        cursor: pointer;
                        text-shadow: 1px 1px #fff;
                        font-weight: 700;
                        font-size: 10pt;
                        }
                        #images-input:hover::before {
                        border-color: black;
                        }
                        #images-input:active {
                        outline: 0;
                        }
                        #images-input:active::before {
                        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9); 
                        }

                        #imgs-grid {
                            position: relative;
                            box-sizing: border-box
                            border: .5px solid #eee;
                            border-radius: 10px;
                            min-height: 250px;
                        }
                        .imageWrap {
                            position: relative;
                        }
                        .imageWrap span {
                            position: absolute;
                            top: 4px;
                            right: 4px;
                            cursor: pointer;
                        }

                        .imageWrap span:hover {
                            opacity: 0.8;
                        }

                        /* output .span--hidden{
                        visibility: hidden;
                        } */
                      
                        /* #images-input {
                            opacity: 0; 
                            position: absolute;
                            left: 0px;    
                            width: 100%;
                            top: 0px;
                            height: 100%;
                        }
                         .cleck-test {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                        } */
                        .note-editor .note-dropzone { opacity: 1 !important; }
                    </style>
                    <div class="form-group droparea mb-2">
                        <div class="col-12 w-100 p-0 ">
                            <div class="col-12 d-flex justify-content-between p-0 " id="head-area">
                                <p class="align-self-center m-0">Imagenes</p>
                                <input type="file" class="" name="image-timeline-upload" id="images-input" multiple accept="image/*">

                                    <label for="images-input" class="btn btn-primary btn-sm">Select some files</label>

                            </div>
                        </div>
                        <div class="imagen-dropyfy mt-2" id="imagen-dropyfy">
                            <div id="imgs-grid">
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect cancel-post-timeline-btn">Cancelar</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light" id="post-timeline-btn">Post</button>
            </div>
        </div>
    </div>
</div>
<div id="logistic-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" id="scroll">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar notas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="logistic-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Add logistic notes:</label>
                        <textarea class="form-control p-text-area post-area-logistic" id="post-area-logistic" rows="4" placeholder="Add logistic notes"></textarea>
                    </div>
                    <style>
                        #imagen-dropyfy-logistic {
                            border-radius: 10px;
                            width: 100%;
                            min-height: 250px;
                            height: auto;
                            border: .5px solid;
                            border-color: #eee;
                            position: relative;
                            overflow-y: auto;
                            overflow-x: hidden;
                        }
                        #images-input-logistic {
                            display: none;
                        }
                        #images-input-logistic::-webkit-file-upload-button {
                        visibility: hidden;
                        }
                        #images-input-logistic::before {
                        content: 'Select some files';
                        color: black;
                        display: inline-block;
                        background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
                        border: 1px solid #999;
                        border-radius: 3px;
                        padding: 5px 8px;
                        outline: none;
                        white-space: nowrap;
                        /* -webkit-user-select: none; */
                        cursor: pointer;
                        text-shadow: 1px 1px #fff;
                        font-weight: 700;
                        font-size: 10pt;
                        }
                        #images-input-logistic:hover::before {
                        border-color: black;
                        }
                        #images-input-logistic:active {
                        outline: 0;
                        }
                        #images-input-logistic:active::before {
                        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9); 
                        }

                        #imgs-grid-logistic {
                            position: relative;
                            box-sizing: border-box
                            border: .5px solid #eee;
                            border-radius: 10px;
                            min-height: 250px;
                        }
                        .imageWrap-logistic {
                            position: relative;
                        }
                        .imageWrap-logistic span {
                            position: absolute;
                            top: 4px;
                            right: 4px;
                            cursor: pointer;
                        }

                        .imageWrap-logistic span:hover {
                            opacity: 0.8;
                        }
                        .note-editor .note-dropzone { opacity: 1 !important; }
                    </style>
                    <div class="form-group droparea mb-2">
                        <div class="col-12 w-100 p-0 ">
                            <div class="col-12 d-flex justify-content-between p-0 " id="head-area">
                                <p class="align-self-center m-0">Imagenes</p>
                                <input type="file" class="" name="image-logistic-upload" id="images-input-logistic" multiple accept="image/*">

                                    <label for="images-input-logistic" class="btn btn-primary btn-sm">Select some files</label>

                            </div>
                        </div>
                        <div class="imagen-dropyfy mt-2" id="imagen-dropyfy-logistic">
                            <div id="imgs-grid-logistic">
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect cancel-post-logistic-btn">Cancelar</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light" id="post-logistic-btn">Post</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="treatmenta-availables-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Paquetes sugeridos para el tratamiento recomendado disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirm-change-procedure-button-with-new-package">Change</button>
            </div>
        </div>
    </div>
</div>
<style>
    .note-editable > p {
        margin: 0 !important;
    }
</style>

@endsection
@section('styles')
<link href="{{ asset('staffFiles/assets/plugins/datatables/datatables.min.css') }}"  rel="stylesheet">
<link href="{{ asset('staffFiles/assets/plugins/magnific-popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
@endsection
@section('scripts')
@if (\Session::has('sys-message'))
    <script>
        Toast.fire({
          icon: '{{\Session::get('icon')}}',
          title: '{{\Session::get('msg')}}',
        })
    </script>
@endif
<script src="{{ asset('staffFiles/assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('staffFiles/assets/plugins/magnific-popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('staffFiles/assets/plugins/autosize-master/dist/autosize.min.js') }}"></script>

<script>
    var itemContainer = $(".nice-chat");
    var globalRouteSetNewStaff = "{{ route('staff.applications.setNewStaff') }}";
    var globalRouteGetNewStaff = "{{ route('staff.applications.getNewStaff') }}";
    var globalRouteSendDebateMessage = "{{ route('staff.applications.sendDebateMessage') }}";
    var globalRouteGetNewProcedure = "{{ route('staff.applications.getNewProcedure') }}"
    var globalRouteSetNewProcedure = "{{ route('staff.applications.setNewProcedure') }}"
    var globalRouteGetNewPackage = "{{ route('staff.applications.getNewPackage') }}"
    var globalRouteSetNewPackage = "{{ route('staff.applications.setNewPackage') }}"
    var globalRouteSetStatusAcepted = "{{ route('staff.applications.setStatusAcepted') }}"
    var globalRouteSetStatusDeclined = "{{ route('staff.applications.setStatusDeclined') }}"
    var globalRouteStorePostTimeline = "{{ route('staff.applications.storePostTimeline') }}"
    var globalRouteShowPostTimeline = "{{ route('staff.applications.showPostTimeline') }}"
    var globalRouteChangeNewProcedure = "{{ route('staff.applications.changeNewProcedure') }}"
    var globalRouteChangeNewProcedureWithPackage  = "{{ route('staff.applications.changeNewProcedureWithPackage') }}"
    var globalRouteSetAceptesSuggestion = "{{ route('staff.applications.setAceptesSuggestion') }}"

    var globalRouteStorePostLogistic = "{{ route('staff.applications.storePostLogistic') }}"
    var globalRouteShowPostLogistic = "{{ route('staff.applications.showPostLogistic') }}"


    var user_lang = "{{ Auth::guard('staff')->user()->lang }}";
    var canChangeProcedure = "{{ Auth::guard('staff')->user()->hasRole(['dios', 'super-administrator', 'administrator', 'coordinator']) }}";
    var hideStatusAreaLet = "{{ Auth::guard('staff')->user()->hasRole([['dios', 'super-administrator', 'administrator']]) }}"
    var hideAcdeptedBtnLet = "{{ Auth::guard('staff')->user()->hasRole([['dios']]) }}"


    var date = new Date();   //Creates date object
    var hours = date.getHours();   //get hour using date object
    var minutes = date.getMinutes();    //get minutes using date object
    var ampm = hours >= 12 ? 'pm' : 'am';  //Check wether 'am' or 'pm'

    var month = date.getMonth(); //get month using date object
    var day = date.getDate();    //get day using date object
    var year = date.getFullYear();  //get year using date object
    var dayname = date.getDay();  // get day of particular week

    var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
    var week=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
   
    var dateMessage = monthNames[month] + ' ' + day + ', ' + year + ' '+ hours + ":" + minutes + ampm;

    var debateMembers = {!! json_encode($debateMembers) !!}
    var debate_id = {{ $appInfo->id }}
    var app_id = {{ $appInfo->id }}
    var app_code = '{{ $appInfo->code }}'

    var sugerxxx = {{ $appInfo['treatment']['service_id'] }};

    

    var reciverSound = '{{ asset('sounds/facebook-nuevo mensaje.mp3') }}'

    var baseURL = '{{ asset('/') }}'

    itemContainer.slimscroll({
        scrollTo : '500px',
        start: 'bottom',
        position: "right",
        size: "5px",
        color: "#9ea5ab",
        width: '100%',
        wheelStep: 5
    })

    getTimeLinePost()
    getLogisticPost()

    $(window).scroll(function() {
        if($(window).scrollTop() == $(document).height() - $(window).height()) {
            getTimeLinePost()
        }
    })
    $('#messageInput').summernote({
        placeholder: 'placeholder',
        height: 50,
        toolbar: false,
        disableResizeEditor: true,
    })
    $('#imageRow').magnificPopup({
          delegate: 'a.a',
          type: 'image',
          removalDelay: 500, //delay removal by X to allow out-animation
          callbacks: {
            beforeOpen: function() {
              // just a hack that adds mfp-anim class to markup
               this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
               this.st.mainClass = this.st.el.attr('data-effect');
            }
          },
          closeOnContentClick: true,
          midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });
    $('#messageInput').on('summernote.keydown', function(we, e) {
        if ( e.which === 13 && !e.shiftKey ) {
            e.preventDefault();
            if (!$('#messageInput').val()) {
                return false;
            }
            let message = $('#messageInput').val();
            $.each(debateMembers, function(index, val) {
                 if (val.member_id == user_id) {
                     sendDebateToServer($('#messageInput').val())
                 }
            });
        }
    });
    $(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
       if ($(this).attr('href') == '#debateChat') {debateToDownLast()}
    })
    $('.summernote').summernote({
        placeholder: 'placeholder',
        height: 100,
        toolbar: false,
        disableResizeEditor: true,
    })
    var $myArr = [];
    var $viewArr = [];
    var imagesArray = [];
    var $divimages = [];
    var $altura_arr = [];
    function getTimeLinePost() {
        let $offset = $('.tl-card').length;
        let $limit = 5;
        let $formData = new FormData();
        $formData.append('app', app_id)
        $formData.append('offset', $offset)
        $formData.append('limit', $limit)

        $.ajax({
            url: globalRouteShowPostTimeline,
            method:"POST",
            data:$formData,
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
            success:function(response)
            {
                $.each(response.post, function(i, val) {
                    addNewTimeLinePost(response.post[i], 'append')
                });
            },
            complete: function()
            {
            },
        })
    }
    function setNewStaff(lastValue, lastText, specialty){
        var form_data = new FormData();
        form_data.append('name', lastText);
        form_data.append('id', lastValue);
        form_data.append('app', app_id);
        form_data.append('oldName', ($('#nameStaff'+specialty).text() ? $('#nameStaff'+specialty).text():""));
        form_data.append('specialty', specialty);
        $.ajax({
            url: globalRouteSetNewStaff,
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
            success:function(response)
            {
                console.log(response);
                $("#recommended-procedure-span").html('');
                $("#recommended-procedure-row").html('');
                $('#status-accepted-modal').modal('hide');
                $("#current-status-p").html(response.status);
                $("#span-status-name").html(response.status);

                $('#s-recomendatons-indications').html(response.medicalIndications);
                $('#s-recomendatons-recomendations').html(response.medicalRecommendations);
                $('#s-recomendatons-reazon').remove();
                
                //$('#nameStaff'+specialty).text(response.staff_name);
                console.log(response.status_id);
                socket.emit('sendNewStaffToServer', response.response);
                socket.emit('eventCalendarRefetchToServer');
                socket.emit('updateDataTablesToServer');
                socket.emit('sendChangeAppStatusToServer', response);
                $('#change'+specialty+"App").modal('hide');
                if(response.status_id != 9 ){
                    if(response.status_id != 1){
                        hideAcdeptedBtn()
                    }
                }
            },
            complete: function()
            {
            },
        })
    }
    function sendDebateToServer(messageInput) {
        form_data = new FormData();
        form_data.append('message', messageInput);
        form_data.append('debate', debate_id);
        form_data.append('debateMembers', JSON.stringify(debateMembers));
        let jsonForm={};
        $(".user-status-icon").each(function(i){
           jsonForm[i] = $(this).attr("id");
         })
        form_data.append('members', JSON.stringify(jsonForm));

        $.ajax({
            url: globalRouteSendDebateMessage,
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
            success:function(response)
            {
                if (response.success) {
                    var dataMsg = response.response;
                    var dataMsgUserId = dataMsg.user_id.id;
                    $('#messageInput').summernote('code', '');
                    senderDebate(dataMsg.message)
                    let data = {members:debateMembers,group_id:dataMsg.debate_id, user_id:dataMsgUserId, message:dataMsg.message, dateMessage:dataMsg.timestamp, timeDiff:dataMsg.timeDiff, msgStrac: dataMsg.msgStrac};
                    socket.emit('sendDebateToServer', data);
                }

            },
            complete: function()
            {
            },
        })
    }
    function senderDebate(message) {
        $msg = '<li class="out">';
            $msg += '<img src="{{ asset(getAvatar(auth()->guard('staff')->user())) }} " class="avatar" alt="">';
            $msg += '<div class="message">';
                $msg += '<span class="arrow"></span>';
               $msg += ' <a class="name" href="#">{{ auth()->guard('staff')->user()->name }}</a>';
                $msg += '<span class="datetime"> at ' + dateMessage + '</span>';
                $msg += '<span class="body"> ' + message + ' </span>';
            $msg += '</div>';
        $msg += '</li>';
        $('#chatDiv').append($msg)
        debateToDownLast()
    }
    function debateToDownLast(){
        var container = $('ul.chat');
        var scrollTo = $("ul.chat li:last");
        container.animate({scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()});
    }
    function send_notification($data) {
    }
    function addNewTimeLinePost(data, mode) {
        let $avatar = 'staffFiles/assets/img/user/user.jpg';
        let $countImages = '';
        if (data.staff.image_one !== null) {
            $avatar = data.staff.image_one.image
        }
        let $message = (data.message == null)? '': data.message;
        var date = new Date(data.created_at);
        let $time = moment(date).fromNow()
        let $post = `
            <li class="card p-3 tl-card" post="${data.code}" id="post-${data.id}">
                <div class="avatar">
                    <img src="${baseURL}${$avatar}" alt="" />
                </div>
                <div class="activity-desk">
                    <h5><a href="#">${data.staff.name}</a> <span id="countImages"></span></h5>
                    <small></small>
                    <p class="text-muted">${$time}</p>
                    <div class="activity-desk ml-0">
                        <h5><span>${$message}</span></h5>
                    </div>
                    <hr>
                    <br>
                    <div class="album gallery row w-50" style="margin: 0 auto" id="album-${data.code}">
                    </div>
                </div>
            </li>
        `;
        
        if (mode == 'prepend') {$('.post-timeline-view').prepend($post)} 
        else {$('.post-timeline-view').append($post)}
        
        $countImages = data.image_many.length

            if ($countImages > 0) {
                switch ($countImages) {
                case 1:
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 1)));
                    break;
                case 2:
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 2)));
                    break;
                case 3:
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 1)));
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(1, 3)));
                    break;
                case 4:
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 1)));
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(1, 4)));
                    break;
                case 5:
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 2)));
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(2, 5)));
                    break;
                default:
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 2)));
                    displayPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(2, 5)));
                    break;
                    //Object.fromEntries(Object.entries(foo).slice(1, 3))
            }
        }
        // $('.dropArea').remove();
        var file = document.getElementById('images-input');
        file.value = '';
        $('#post-area-timeline').val('');
        $('#timeline-modal').modal('hide')
        
    }
    function displayPostImages(code, items){
        let count = Object.keys(items).length
        let $album = document.getElementById(`album-${code}`);
        var $row = document.createElement("div");
        $row.classList.add('row', 'm-0', 'h-25');
        $album.appendChild($row);
        $rowWidth = (100 / count);
        var img = "";
        for (const i in items) {
            img += `<div class="${i} imageWrap d-flex" style="width: ${$rowWidth}%">
                    <a href="${baseURL}${items[i].image}">
                        <img class="w-md-100" alt="" src="${baseURL}${items[i].image}" style="padding: 2px;border-radius: 10px;">
                    </a>
            </div>`;
        }
        // <img class="w-100" alt="" src="${baseURL}${items[i].image}" style="padding: 2px;border-radius: 10px;">
        $('.gallery').each(function() { 
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                enabled:true
                }
            });
        });
        $row.innerHTML = img;
    }
    function hideStatusArea(){

        if (! hideStatusAreaLet) {$('#set-status-area-div').css('display', 'none')}
        
    }
    function packageWarning(response) {
        var warning = `
            <br>
            <div class="alert alert-danger " role="alert">
                El paquete del procedimiento requerido es <strong class="oldPackage"> ${response.oldPacka}</strong>. 
                <br>
                Y no se encuentra disponible en el nuevo procedimiento: <strong>${response.oldProce}</strong>
                <br>
                por favor informe al Paciente sobre el nuevo procedimiento y nuevo paquete 
                <br>
                los Paquetes disponibles para <strong>${response.oldProce}</strong> son:
                <ul class="availablePackahesList">  
                </ul>
            </div>
        `;

        $('.packageDosentExist').append(warning)

        $.each(response.packs, function(index, val) {
            var item = `<li> ${response.packs[index].package}</li>`;
            $('.availablePackahesList').append(item)

        });
    }
    function surggeriesWaning(response){
        var warning = `
            <br>
            <div class="alert alert-danger " role="alert">
                El paquete del procedimiento requerido es <strong class="oldPackage"> ${response.oldPacka}</strong>. 
                <br>
                Y no se encuentra disponible en el nuevo procedimiento: <strong>${response.oldProce}</strong>
                <br>
                por favor informe al Paciente sobre el nuevo procedimiento y nuevo paquete 
                <br>
                los Paquetes disponibles para <strong>${response.oldProce}</strong> son:
                <ul class="availablePackahesList">  
                </ul>
            </div>
        `;

        //$('.packageDosentExist').append(warning)

        $.each(response.sugerencia, function(index, val) {
            var item = `<li> <strong> ${response.packs[index].package} </strong></li>`;
            $('.availableSuggestionsList').append(item)

        });
    }
    function hideAcdeptedBtn(){
        if(!hideAcdeptedBtnLet){$('#status-accepted-button').remove();}
    }
    function clearArrayImages(){
        $myArr = [];
        $viewArr = [];
        imagesArray = [];
        $divimages = [];
        $altura_arr = [];
        $('.imgs-grid-image').remove();
        $('#imgs-grid').html('');
        console.log(imagesArray);
    }
    function deleteImage(index) {
        imagesArray.splice(index, 1)
        displayImages()
    }
    var input = document.getElementById('images-input')
    var output = document.getElementById('imagen-dropyfy')
    input.addEventListener("change", () => {
        const files = input.files
        console.log(files)
        for (let i = 0; i < files.length; i++) {
            imagesArray.push(files[i])
        }
        uploadImagePreview()
    })
    function deleteImage(index) {
        imagesArray.splice(index, 1)
        console.log(index);
        uploadImagePreview()
    }
    function uploadImagePreview() {
        $('#imgs-grid').html('')
        let $arCount = imagesArray.length;


        switch ($arCount) {
            case 1:
                displayImages(imagesArray.slice(0, 1));
                break;
            case 2:
                displayImages(imagesArray.slice(0, 2));
                break;
            case 3:
                displayImages(imagesArray.slice(0, 1));
                displayImages(imagesArray.slice(1, 3));
                break;
            case 4:
                displayImages(imagesArray.slice(0, 1));
                displayImages(imagesArray.slice(1, 4));
                break;
            case 5:
                displayImages(imagesArray.slice(0, 2));
                displayImages(imagesArray.slice(2, 5));
                break;
            default:
                displayImages(imagesArray.slice(0, 2));
                displayImages(imagesArray.slice(2, 5));
                break;
        }
        //$imgsGrid.appendChild($newDiv)
        //uploadImagePreview()
    }
    function displayImages(items){
        $rowWidth = (100 / items.length)
        var $grid = document.getElementById("imgs-grid");
        var $row = document.createElement("div");
        $row.classList.add('row', 'm-0');
        $grid.appendChild($row);
        var $img = document.createElement('img')
        var _URL = window.URL || window.webkitURL;
        var file, imgs;
        let img = ""
        items.forEach((image, index) => {
            img += `<div class="${index} imageWrap" style="width: ${$rowWidth}%">
                    <img class="w-100" alt="" src="${URL.createObjectURL(image)}" style="padding: 2px;border-radius: 10px;">

                    <span class="details delImage" index="${index}">
                        <span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-times"></i></span> 
                    </span>
            </div>`;
        })
        $row.innerHTML = img;

        $delBtns = document.getElementsByClassName('delImage');
        for (i = 0; i < $delBtns.length; i++) {
           $delBtns[i].setAttribute("onclick",`deleteImage(${i})`);
        }
    }
    $(document).on('click', '.cancel-post-timeline-btn', function(event) {
        event.preventDefault();
        $('.dropArea').remove();
        $('#images-input').empty();
        $("#images-input").val('');
        $('#post-area-timeline').val('');
        clearArrayImages()
        $('#timeline-modal').modal('hide')
    });
    $(document).on('click', '#post-timeline-btn', function(event) {
        event.preventDefault();
        event.stopPropagation();
        let $message = $('.post-area-timeline').summernote('code');
        let $images = $('#images-input').prop('files')
        let $imagesCount = $('#images-input').prop('files').length;
        let $imageArr = [];
        let $formData = new FormData();
        $.each(imagesArray, function(i, img) {
            if (img) {
                $formData.append("file[]", img);
                $imageArr.push(img)
                console.log(img)
                alert(img.size)
            }
        });
        $formData.append('app', app_id);
        $formData.append('message', $message);
        $.ajax({
            url: globalRouteStorePostTimeline,
            method:"POST",
            data:$formData,
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
            success:function(response)
            {
            console.log("response", response);
                if (response.success) {
                    Toast.fire({
                        icon: response.icon,
                        title: response.message,
                    })

                    addNewTimeLinePost(response.post, 'prepend');
                    clearArrayImages()
                }
            },
            complete: function()
            {
            },
        })  
    });
    $(document).on('click', '[id^="appChange"]', function(event) {
        event.preventDefault();
        var specialty = $(this).attr('id').split("appChange")
        specialtyFormated = specialty[1].replace("_", " ");
        $("#getStaff"+specialty[1]).empty().attr('placeholder', "Select click here").trigger('change')
        $('#change'+specialty[1]+"App").on('show.bs.modal', function (e) {
            $('#getStaff'+specialty[1]).select2({
                dropdownParent: $('#change'+specialty[1]+"App"),
                placeholder: "Select click here",
                allowClear: true,
                ajax: {
                    url: globalRouteGetNewStaff,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                            specialty: specialtyFormated,
                            app: app_id,
                        }
                    },
                    processResults: function(data) {
                        console.log(data);
                        return {
                            results: $.map(data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.name
                                };
                            })
                        };
                    },
                    cache: true,
                }
            }).on("change", function(e) {
                //$("#getStaff"+specialty[1]).empty()
                var lastValue = $.trim(e.currentTarget.value);
                var lastText = $.trim(e.currentTarget.textContent);
                setNewStaff(lastValue, lastText, specialty[1])
            });
        }).modal('show');
    });
    $(document).on('click', '#change-procedure-button', function(event) {
        event.preventDefault();
        var code = document.getElementById('change-procedure-p').getAttribute('code');

        form_data = new FormData();
        form_data.append('app_id', app_id);
        form_data.append('tr_cod', 'code');
        $.ajax({
                url: globalRouteChangeNewProcedure,
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
                    $('#treatmenta-availables-modal  .modal-body').html('');
                },
                success:function(response)
                {
                    
                    console.log("response", response);
                    if (response.success) {
                        $('#change-procedure-p').html(response.name);
                        $('#change-procedure-p').attr('procedure_id', response.id);
                        $('#change-procedure-select').empty().attr('placeholder', "Select click here").trigger('change');
                        $('#change-procedure-modal').modal('hide');
                        if (response.has_package == 0) {
                            $('#change-procedure-button').show('fast');
                            $('#change-package-p').html('----')
                        }
                        $("#recommended-procedure-span").html('')
                        $("#recommended-procedure-row").html('')
                        $("#current-status-p").html(response.status)
                        $("#span-status-name").html(response.status)

                        // 'indications' => $status->statusOne->status->medicalIndications,
                        //         'recomendations' => $status->statusOne->status->medicalRecommendations,
                        //         'reazon' => $status->statusOne->status->reazon,
                        socket.emit('sendChangeAppProcedureToServer', response);
                        socket.emit('updateDataTablesToServer');
                        socket.emit('eventCalendarRefetchToServer');
                    }

                    if (response.hasOwnProperty('complete')) {
                        if (! response.complete) {
                            for (var i = 0; i < response.treatment.length; i++) {

                                let treatments_options = `  

                                    <div class="form-check">
                                        <input class="form-check-input" code="${response.treatment[i].code}" value="${response.treatment[i].id}" type="radio" name="new_treatment-with-package" id="new_treatment-with-package-${i}">
                                        <label class="form-check-label" for="flexRadioDefault1" style="font-size: .8rem">
                                            ${response.treatment[i].procedure.procedure} ---- ${response.treatment[i].package.package}
                                        </label>
                                    </div>
                                `
                                $('#treatmenta-availables-modal .modal-body').append(treatments_options);
                            }
                            
                            $('#treatmenta-availables-modal').modal('show');

                        }
                       
                    }

                    if (response.hasOwnProperty('icon')) {
                        Toast.fire({
                          icon: response.icon,
                          title: response.msg
                        })
                    }
                    if (response.hasOwnProperty('reload')) {
                        location.reload();
                    }
                },
                complete: function()
                {
                },
            })
    });
    $(document).on('click', '#suggestion-procedure-checkbox' ,function () {
        if ($(this).is(":checked")) {
          
            let form_data = new FormData()
            form_data.append('app', app_id);
            $.ajax({
                url: globalRouteSetAceptesSuggestion,
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
                success:function(response)
                {
                    console.log("response", response);
                    if (response.success) { 
                        $('#recommended-procedure-row').remove();
                        $("#current-status-p").html(response.status)
                        $("#span-status-name").html(response.status)
                        $('#s-recomendatons-indications').html(response.indications)
                        $('#s-recomendatons-recomendations').html(response.recomendations)
                        $('#s-recomendatons-reazon').remove()
                        hideAcdeptedBtn()
                    }
                    if (response.hasOwnProperty('icon')) {
                        Toast.fire({
                          icon: response.icon,
                          title: response.msg
                        })
                    }
                    if (response.hasOwnProperty('reload')) {
                        location.reload();
                    }
                },
                complete: function()
                {
                },
            })
        } 
    });
    $(document).on('click', '#confirm-change-procedure-button', function(event) {
        event.preventDefault();
        var data = $('#change-procedure-select').select2('data');
        if (data.length > 0) {
            var id = data[0].id
            var name = data[0].text
            var has_package = data[0].package;
            var form_data = new FormData();
            form_data.append('name', name);
            form_data.append('id', id);
            form_data.append('app', app_id);
            $.ajax({
                url: globalRouteSetNewProcedure,
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
                success:function(response)
                {
                    console.log("response", response);
                    console.log('response');
                    if (response.success) {
                        $('#change-procedure-p').html(response.name);
                        $('#change-procedure-p').attr('procedure_id', response.id);
                        $('#change-procedure-select').empty().attr('placeholder', "Select click here").trigger('change');
                        $('#change-procedure-modal').modal('hide');
                        if (response.has_package == 0) {
                            $('#change-package-p').html('');
                            $('#change-procedure-button').hide('fast');
                        } else {
                            $('#change-procedure-button').show('fast');
                        }
                        hideStatusArea()
                        $("#recommended-procedure-span").html('')
                        $("#recommended-procedure-row").html('')
                        $("#current-status-p").html(response.status)
                        $("#span-status-name").html(response.status)
                        socket.emit('sendChangeAppProcedureToServer', response);
                        socket.emit('updateDataTablesToServer');
                        socket.emit('eventCalendarRefetchToServer');
                    }
                    if (response.hasOwnProperty('icon')) {
                        Toast.fire({
                          icon: response.icon,
                          title: response.msg
                        })
                    }
                    if (response.hasOwnProperty('reload')) {
                        location.reload();
                    }
                },
                complete: function()
                {
                },
            })

        }
    });
    $(document).on('click', '#change-package-button', function(event) {
        event.preventDefault();
        $('#change-package-modal').on('show.bs.modal', function () {
            $('#change-package-select').empty().attr('placeholder', "Select click here").trigger('change')
            $('#change-package-select').select2({
                placeholder: "Select click here",
                allowClear: true,
                ajax: {
                    url: globalRouteGetNewPackage,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                            app: app_id,
                        }
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                                console.log("data", data);
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
        }).modal('show')
    });
    $(document).on('click', '#confirm-change-package-button', function(event) {
        event.preventDefault();
        var data = $('#change-package-select').select2('data');
        if (data.length > 0) {
            var id = data[0].id
            var name = data[0].text
            var form_data = new FormData();
            form_data.append('name', name);
            form_data.append('id', id);
            form_data.append('app', app_id);
            $.ajax({
                url: globalRouteSetNewPackage,
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
                success:function(response)
                {

                    console.log("response", response);
                    if (response.success) {
                        $('#change-package-p').html(response.name);
                        $('#change-package-p').attr("package_id", response.id);
                        $('#change-package-select').empty().attr('placeholder', "Select click here").trigger('change');
                        $('#change-package-modal').modal('hide');
                        if (response.has_package == 0) {
                            $('#change-package-p').html('');
                            $('#change-package-button').hide('fast');
                        } else {
                            $('#change-package-button').show('fast');
                        }
                        socket.emit('sendChangeAppPackageToServer', response);
                        socket.emit('updateDataTablesToServer');
                        socket.emit('eventCalendarRefetchToServer');
                    }

                    if (response.hasOwnProperty('exist')) {

                        if (response.exist) {
                            $('.packageDosentExist').css('display', 'none');
                        } else {
                            $('.packageDosentExist').css('display', 'block');
                            $('.oldPackage').html(response.name)
                        }
                    }
                    if (response.hasOwnProperty('icon')) {
                        Toast.fire({
                          icon: response.icon,
                          title: response.msg
                        })
                    }
                    if (response.hasOwnProperty('reload')) {
                        location.reload();
                    }
                },
                complete: function()
                {
                },
            })
        }
    });
    $(document).on('click', '#status-accepted-button', function(event) {
        event.preventDefault();

        $('#status-accepted-modal').on('show.bs.modal', function () {
            if (sugerxxx == "2") {
                $('.data-status-select').click();
            }
            $('#accepted-status-select').empty().attr('placeholder', "Select click here").trigger('change')
            $('#accepted-status-select').append('<option selected  value=" ' + $('#change-procedure-p').attr('procedure_id') + ' ">' + $('#change-procedure-p').html() + '</option>').trigger('change')
            $('#accepted-status-select').select2({
                placeholder: "Select click here",
                allowClear: false,
                ajax: {
                    url: globalRouteGetNewProcedure,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                            app: app_id,
                        }
                    },
                    processResults: function(data) {
                        
                        return {
                            results: $.map(data, function(obj) {
                                console.log(data)
                                return {
                                    id: obj.id,
                                    text: obj.procedure,
                                    package: obj.has_package,
                                    code: obj.code,
                                };
                            })
                        };
                    },
                    cache: true,
                }
            })
        }).modal('show')
    });
    $(document).on('click', '#confirm-status-accepted-button', function(event) {
        event.preventDefault();

        var data = $('#accepted-status-select').select2('data');
        if (data.length > 0) {
            let id = data[0].id
            let name = data[0].text
            let code = data[0].code
            let medicalRecommendations = $('#medicalRecommendations').val()
            let medicalIndications = $('#medicalIndications').val();
            let action = event.target.getAttribute('action');
            let codigo = event.target.getAttribute('code');
            let checkboxes = document.querySelectorAll('.cbSugerencias input[type=checkbox]:checked');

            let array = [];
            $(checkboxes).each(function (index, element) {    

                array[index] = {
                    'id':$(this).val(),
                    'nombre':$(this).attr('nombre'),
                    'code':$(this).attr('code')
                }        
            });
            let form_data = new FormData();
            form_data.append('name', name);
            form_data.append('id', id);
            form_data.append('code', code);
            form_data.append('medicalRecommendations', medicalRecommendations);
            form_data.append('medicalIndications', medicalIndications);
            form_data.append('action', action);
            form_data.append('codigo', codigo);


            form_data.append('sugerencias', JSON.stringify(array));

            form_data.append('app', app_id);
            $.ajax({
                url: globalRouteSetStatusAcepted,
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
                    $('.errors').remove();
                    $('.btn-status-acept').removeClass('d-none')
                    return
                },
                success:function(response)
                {
                console.log("response", response);

                    if (!response.success) {
                        $('.btn-status-acept').addClass('d-none');
                    }

                    if (response.success) {
                        $("#recommended-procedure-span").html('')
                        $("#recommended-procedure-row").html('')
                        $('#status-accepted-modal').modal('hide')

                        $("#current-status-p").html(response.status)
                        $("#span-status-name").html(response.status)
                        hideStatusArea()
                        $('#status-accepted-modal').modal('hide')
                        //$('#status-accepted-button').remove()
                        //hideAcdeptedBtn()
                        let checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
                        $(checkboxes).each(function (index, element) {
                            $(this).prop('checked', false);
                        });
                        $('#status-accepted-modal').modal('hide')
                    }

                    if (!response.success) {
                        $.each( response.errors, function( key, value ) {
                            $real = key.replace('.', '-')
                            console.log($real)
                            $('*[id^='+$real+']').parent().find('.help-block').append('<strong class="errors">' + value + '</strong>')
                            //$('*[id^='+$real+']').remove()
                        });
                    }
                    $('#s-recomendatons-indications').html(response.indications)
                    $('#s-recomendatons-recomendations').html(response.recomendations)
                    $('#s-recomendatons-reazon').remove()

                    
                    if (response.hasOwnProperty('data')) {
                       
                        var recommended = `   
                            <div class="col-6 mb-2 b-r"> <strong>Procedimiento sugerido: ${response.name}</strong>'
                                <div class="packageDosentExist" id="packageDosentExist">
                                    
                                </div>
                                '<br>'
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="recommended-procedure-checkbox">
                                    <label class="form-check-label" for="recommended-procedure-checkbox" id="recommended-procedure-span">El paciente acepta el cambio? </label>
                                </div>
                            </div>
                        `
                        var btn = ""
                        $("#recommended-procedure-span").html(response.name)
                        $("#recommended-procedure-row").html(recommended)
                    }


                    if (response.hasOwnProperty('datax')) {  
                        var data = `
                        <div class="suggestionsDosentExist" id="suggestionsDosentExist">
                            <div class="alert alert-danger " role="alert">
                                <p>El doctor <strong>${response.doctor}</strong> a sugerido otros procedimientos,</p>   

                                    <p>los procedimientos sugeridos son:</p>

                                    <ul class="availableSuggestionsList">
                                        
                                    </ul>
                                    <br>
                                    <p>por favor espere a que administracion realiza una cotización é informe al paciente sobre los nuevos procedimientos</p> 
                                    <br>
                                </div>
                            </div>
                            <br>
                            <div class="form-group form-check mb-auto">
                                <input type="checkbox" class="form-check-input" id="suggestion-procedure-checkbox">
                                <label class="form-check-label" for="suggestion-procedure-checkbox" id="recommended-procedure-span">El paciente acepta la cotización?* </label>
                            </div>
                        </div>
                        `
                        $("#recommended-procedure-row").html(data)
                    }

                    if (response.exist != null) {
                        $('#packageDosentExist').css('display', 'none');
                    } else {
                        $('packageDosentExist').remove();
                        packageWarning(response)
                    }

                    if (response.hasOwnProperty('sugerencia')) {
                        surggeriesWaning(response);
                    }

                    socket.emit('updateDataTablesToServer');
                    socket.emit('sendChangeAppStatusToServer', response);
                },
                complete: function()
                {
                },
            })

        } else {
            $('#accepted-procedure-select').parents('.col-md-12').find('.help-block').html('Please select procedure')
        }
    });
    $(document).on('click', '.data-status-select',function (event) {
        //const ele = this.getElementsByClassName('data-status-select')
        console.log(event);
        let step = document.getElementsByClassName('step');
        let code = event.target.getAttribute('code');
        let visible = event.target.getAttribute('status')
        let checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
        let stepCount = step.length;
        $('#confirm-status-accepted-button').attr('action', visible)
        $('#confirm-status-accepted-button').attr('code', code);

        for (var i = 0; i < stepCount; i++) {
            step[i].classList.add('d-none')
        }
        $(this).parents('.modal-body').find(`[data-id='${visible}']`).removeClass('d-none')

        $(checkboxes).each(function (index, element) {
            $(this).prop('checked', false);
        });
    });
    $(document).on('change', "#recommended-procedure-checkbox", function () {
        if ($(this).is(":checked")) {
            var btn = ""
            btn += '<p><button id="change-procedure-button" class="btn btn-warning btn-sm">Change</button></p>';
            if ( $("#change-procedure-p") ) {
              $("#change-procedure-p").append(btn);
            }
        }
    });
    $(document).on('click', '#status-declined-button', function(event) {
        event.preventDefault();
        $('#status-declined-modal').on('show.bs.modal', function () {

        }).modal('show')
    });
    $(document).on('click', '#confirm-status-declined-button', function(event) {
        event.preventDefault();

        var declinedReazon = $('#declined-app').val();
        var form_data = new FormData();
        form_data.append('declinedReazon', declinedReazon);
        form_data.append('app', app_id);
        $.ajax({
            url: globalRouteSetStatusDeclined,
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
            success:function(response)
            {

                $("#current-status-p").html(response.status)
                $("#span-status-name").html(response.status)
                hideStatusArea()
                console.log("hideStatusArea", hideStatusArea);
                socket.emit('updateDataTablesToServer');
                socket.emit('sendChangeAppStatusToServer', response);
                $('#status-declined-modal').modal('hide');
            },
            complete: function()
            {
            },
        })
    });
    $(document).on('input', '.note-editable', function () {
        $target = $('#images-input');
        $('.modal-body').animate({
            scrollTop: $target.offset().top + 'px'
        }, 'slow');

    });
    $(document).on('click', '#post-area-timeline', function(event) {
        event.preventDefault();
        $('#timeline-modal').modal('show')
    });
    $(document).on('click', '#confirm-change-procedure-button-with-new-package', function(event) {
        event.preventDefault();
        $val = document.querySelector('input[name="new_treatment-with-package"]:checked').value;
        $cod = document.querySelector('input[name="new_treatment-with-package"]:checked').getAttribute("code");
        form_data = new FormData();
        form_data.append('app', app_id);
        form_data.append('tr_cod', $cod);
        form_data.append('tr_id', $val);
        $.ajax({
                url: globalRouteChangeNewProcedureWithPackage,
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
                success:function(response)
                {
                    console.log(response)
                    if (response.success) {
                        $('#change-procedure-p').html(response.procedure);
                        $('#change-procedure-p').attr('procedure_id', response.procedure.id);
                        
                        $('#change-package-select').empty().attr('placeholder', "Select click here").trigger('change');
                        $('#change-package-modal').modal('hide');
                        $('.packageDosentExist').css('display', 'none');
                        if (response.has_package == 0) {
                            $('#change-package-p').html('');
                            $('#change-procedure-button').hide('fast');
                        } else {
                            $('#change-procedure-button').show('fast');
                            $('#change-package-p').html(response.package);
                            $('#change-package-p').attr("package_id", response.id);
                        }
                        hideStatusArea()
                        $('#treatmenta-availables-modal').modal('hide');
                        $("#recommended-procedure-span").html('')
                        $("#recommended-procedure-row").html('')
                        $("#current-status-p").html(response.status)
                        $("#span-status-name").html(response.status)

                        $('#s-recomendatons-indications').html(response.medicalIndications)
                        $('#s-recomendatons-recomendations').html(response.medicalRecommendations)
                        $('#s-recomendatons-reazon').remove()
                        socket.emit('sendChangeAppProcedureAndPackageToServer', response);
                        socket.emit('updateDataTablesToServer');
                        socket.emit('eventCalendarRefetchToServer');
                    }

                    if (response.hasOwnProperty('complete')) {
                        if (! response.complete) {


                            $('#treatmenta-availables-modal  .modal-body').html();
                            for (var i = 0; i < response.treatment.length; i++) {

                                let treatments_options = `  

                                    <div class="form-check">
                                        <input class="form-check-input" code="${response.treatment[i].code}" value="${response.treatment[i].id}" type="radio" name="new_treatment-with-package" id="new_treatment-with-package-${i}">
                                        <label class="form-check-label" for="flexRadioDefault1" style="font-size: .8rem">
                                            ${response.treatment[i].procedure.procedure} ---- ${response.treatment[i].package.package}
                                        </label>
                                    </div>
                                `
                                $('#treatmenta-availables-modal  .modal-body').append(treatments_options);
                            }
                            // console.log(response.treatments[i].group_en)
                            
                            $('#treatmenta-availables-modal').modal('show');

                        }
                       
                    }

                    if (response.hasOwnProperty('icon')) {
                        Toast.fire({
                          icon: response.icon,
                          title: response.msg
                        })
                    }
                    if (response.hasOwnProperty('reload')) {
                        location.reload();
                    }
                },
                complete: function()
                {
                },
            })

    });
    $('.post-area-timeline').summernote({
            placeholder: 'Agregar notas',
            height: 'auto',
            toolbar: false,
            disableResizeEditor: true,
            disableDragAndDrop:true,
    })
    $('#timeline-modal').on('hidden.bs.modal', function (e) {
    })
////////////////////

    $(document).on('click', '#post-area-logistic', function(event) {
        event.preventDefault();
        $('#logistic-modal').modal('show')
    });
    $('.post-area-logistic').summernote({
        placeholder: 'Agregar notas',
        height: 'auto',
        toolbar: false,
        disableResizeEditor: true,
        disableDragAndDrop:true,
    })
    $('#logistic-modal').on('hidden.bs.modal', function (e) {
    })

    var $myArr_logistic = [];
    var $viewArr_logistic = [];
    var imagesArray_logistic = [];
    var $divimages_logistic = [];
    var $altura_arr_logistic = [];
    function getLogisticPost() {
        let $offset = $('.tl-card').length;
        let $limit = 5;
        let $formData = new FormData();
        $formData.append('app', app_id)
        $formData.append('offset', $offset)
        $formData.append('limit', $limit)

        $.ajax({
            url: globalRouteShowPostLogistic,
            method:"POST",
            data:$formData,
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
            success:function(response)
            {
                $.each(response.post, function(i, val) {
                    addNewLogisticPost(response.post[i], 'append')
                });
            },
            complete: function()
            {
            },
        })
    }
    function addNewLogisticPost(data, mode) {
        let $avatar = 'staffFiles/assets/img/user/user.jpg';
        let $countImages = '';
        if (data.staff.image_one !== null) {
            $avatar = data.staff.image_one.image
        }
        let $message = (data.message == null)? '': data.message;
        var date = new Date(data.created_at);
        let $time = moment(date).fromNow()
        let $post = `
            <li class="card p-3 tl-card" post="${data.code}" id="post-${data.id}">
                <div class="avatar">
                    <img src="${baseURL}${$avatar}" alt="" />
                </div>
                <div class="activity-desk">
                    <h5><a href="#">${data.staff.name}</a> <span id="countImages"></span></h5>
                    <small></small>
                    <p class="text-muted">${$time}</p>
                    <div class="activity-desk ml-0">
                        <h5><span>${$message}</span></h5>
                    </div>
                    <hr>
                    <br>
                    <div class="album galleryLogistic row w-50" style="margin: 0 auto" id="album-${data.code}">
                    </div>
                </div>
            </li>
        `;
        if (mode == 'prepend') {$('.post-logistic-view').prepend($post)} 
        else {$('.post-logistic-view').append($post)}
        
        $countImages = data.image_many.length

            if ($countImages > 0) {
                switch ($countImages) {
                case 1:
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 1)));
                    break;
                case 2:
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 2)));
                    break;
                case 3:
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 1)));
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(1, 3)));
                    break;
                case 4:
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 1)));
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(1, 4)));
                    break;
                case 5:
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 2)));
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(2, 5)));
                    break;
                default:
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(0, 2)));
                    displayLogisticPostImages(data.code, Object.fromEntries(Object.entries(data.image_many).slice(2, 5)));
                    break;
                    //Object.fromEntries(Object.entries(foo).slice(1, 3))
            }
        }
        // $('.dropArea').remove();
        var file = document.getElementById('images-input-logistic');
        file.value = '';
        $('#post-area-logistic').val('');
        $('#logistic-modal').modal('hide')
        
    }
    function displayLogisticPostImages(code, items){
        let count = Object.keys(items).length
        let $album = document.getElementById(`album-${code}`);
        var $row = document.createElement("div");
        $row.classList.add('row', 'm-0', 'h-25');
        $album.appendChild($row);
        $rowWidth = (100 / count);
        var img = "";
        for (const i in items) {
            img += `<div class="${i} imageWrap-logistic d-flex" style="width: ${$rowWidth}%">
                    <a href="${baseURL}${items[i].image}">
                        <img class="w-md-100" alt="" src="${baseURL}${items[i].image}" style="padding: 2px;border-radius: 10px;">
                    </a>
            </div>`;
        }
        // <img class="w-100" alt="" src="${baseURL}${items[i].image}" style="padding: 2px;border-radius: 10px;">
        $('.galleryLogistic').each(function() { 
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                enabled:true
                }
            });
        });
        $row.innerHTML = img;
    }
    var input_logistic = document.getElementById('images-input-logistic')
    var output_logistic = document.getElementById('imagen-dropyfy-logistic')
    input_logistic.addEventListener("change", () => {
        const files = input_logistic.files
        for (let i = 0; i < files.length; i++) {
            imagesArray_logistic.push(files[i])
        }
        uploadLogisticImagePreview()
    })
    function deleteImageLogistic(index) {
        imagesArray_logistic.splice(index, 1)
        console.log(index);
        uploadLogisticImagePreview()
    }
    function uploadLogisticImagePreview() {
        $('#imgs-grid-logistic').html('')
        let $arCount = imagesArray_logistic.length;
        switch ($arCount) {
            case 1:
                displayLogisticImages(imagesArray_logistic.slice(0, 1));
                break;
            case 2:
                displayLogisticImages(imagesArray_logistic.slice(0, 2));
                break;
            case 3:
                displayLogisticImages(imagesArray_logistic.slice(0, 1));
                displayLogisticImages(imagesArray_logistic.slice(1, 3));
                break;
            case 4:
                displayLogisticImages(imagesArray_logistic.slice(0, 1));
                displayLogisticImages(imagesArray_logistic.slice(1, 4));
                break;
            case 5:
                displayLogisticImages(imagesArray_logistic.slice(0, 2));
                displayLogisticImages(imagesArray_logistic.slice(2, 5));
                break;
            default:
                displayLogisticImages(imagesArray_logistic.slice(0, 2));
                displayLogisticImages(imagesArray_logistic.slice(2, 5));
                break;
        }
        //$imgsGrid.appendChild($newDiv)
        //uploadImagePreview()
    }
    function displayLogisticImages(items){
        $rowWidth = (100 / items.length)
        var $grid = document.getElementById("imgs-grid-logistic");
        var $row = document.createElement("div");
        $row.classList.add('row', 'm-0');
        $grid.appendChild($row);
        var $img = document.createElement('img')
        var _URL = window.URL || window.webkitURL;
        var file, imgs;
        let img = ""
        items.forEach((image, index) => {
            img += `<div class="${index} imageWrap-logistic" que? style="width: ${$rowWidth}%">
                    <img class="w-100" alt="" src="${URL.createObjectURL(image)}" style="padding: 2px;border-radius: 10px;">

                    <span class="details delImage-logistic" index="${index}">
                        <span class="notification-icon circle deepPink-bgcolor"><i class="fa fa-times"></i></span> 
                    </span>
            </div>`;
        })
        $row.innerHTML = img;

        $delBtns = document.getElementsByClassName('delImage-logistic');
        for (i = 0; i < $delBtns.length; i++) {
           $delBtns[i].setAttribute("onclick",`deleteImageLogistic(${i})`);
        }
    }
    $(document).on('click', '.cancel-post-logistic-btn', function(event) {
        event.preventDefault();
        $('.dropArea-logistic').remove();
        $('#images-input-logistic').empty();
        $("#images-input-logistic").val('');
        $('#post-area-logistic').val('');
        clearArrayLogisticImage()
        $('#logistic-modal').modal('hide')
    });
    $(document).on('click', '#post-logistic-btn', function(event) {
        event.preventDefault();
        event.stopPropagation();
        let $message = $('.post-area-logistic').summernote('code');
        let $images = $('#images-input-logistic').prop('files')
        let $imagesCount = $('#images-input-logistic').prop('files').length;
        let $imageArr = [];
        let $formData = new FormData();
        $.each(imagesArray_logistic, function(i, img) {
            if (img) {
                $formData.append("file[]", img);
                $imageArr.push(img)
            }
        });
        $formData.append('app', app_id);
        $formData.append('message', $message);
        $.ajax({
            url: globalRouteStorePostLogistic,
            method:"POST",
            data:$formData,
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
            success:function(response)
            {
            console.log("response", response);
                if (response.success) {
                    Toast.fire({
                        icon: response.icon,
                        title: response.message,
                    })

                    addNewLogisticPost(response.post, 'prepend');
                    clearArrayLogisticImage()
                }
            },
            complete: function()
            {
            },
        })  
    });
    function clearArrayLogisticImage (){
        $myArr_logistic = [];
        $viewArr_logistic = [];
        imagesArray_logistic = [];
        $divimages_logistic = [];
        $altura_arr_logistic = [];
        $('.imgs-grid-image-logistic').remove();
        $('#imgs-grid-logistic').html('');
    }

    //
    socket.on('sendChangeAppProcedureToClient', (response) =>  {
        if (response.success) {
            $('#change-procedure-p').html(response.name);
            $('#change-procedure-p').attr('procedure_id', response.id);
            $('#change-procedure-select').empty().attr('placeholder', "Select click here").trigger('change');
            $('#change-procedure-modal').modal('hide');
            $("#span-status-name").html(response.status)
            if (response.has_package == 0) {
                $('#change-package-p').html('');
                $('#change-procedure-button').hide('fast');
            } else {
                $('#change-procedure-button').show('fast');
                $('#change-package-p').html('----')
            }
            hideStatusArea()
        }
    });

    socket.on('sendChangeAppProcedureAndPackageToClient', (response) =>  {
        if (response.success) {
            $('#change-procedure-p').html(response.procedure);
            $('#change-procedure-p').attr('procedure_id', response.procedure.id);
            $('#change-package-p').html(response.package);
            $('#change-package-p').attr("package_id", response.id);
            $('#change-package-select').empty().attr('placeholder', "Select click here").trigger('change');
            $('#change-package-modal').modal('hide');
            $('.packageDosentExist').css('display', 'none');
            $("#span-status-name").html(response.status);
            $("#current-status-p").html(response.status)
            if (response.has_package == 0) {
                $('#change-package-p').html('');
                $('#change-procedure-button').hide('fast');
            } else {
                $('#change-procedure-button').show('fast');
                $('#change-package-p').html(response.package);
                $('#change-package-p').attr("package_id", response.id);
            }
            $("#recommended-procedure-span").html('')
            $("#recommended-procedure-row").html('')
            $("#current-status-p").html(response.status)
            hideStatusArea()
        }
    });

    socket.on('sendChangeAppPackageToClient', (response) =>  {
        if (response.success) {
            $('#change-package-p').html(response.name);
            $('#change-package-p').attr("package_id", response.id);
            $('#change-package-select').empty().attr('placeholder', "Select click here").trigger('change');
            $('#change-package-modal').modal('hide');
            if (response.has_package == 0) {
                $('#change-package-p').html('');
                $('#change-package-button').hide('fast');
            } else {
                $('#change-package-button').show('fast');
            }
            if (response.exist) {
                $('.packageDosentExist').css('display', 'none');
            } else {
                $('.packageDosentExist').css('display', 'block');
                $('.oldPackage').html(response.name)
            }
            hideStatusArea()
        }
    });

    socket.on('sendDebateToClient', (data) => {
        if (data.group_id == debate_id) {
            $.each(data.members, function(i, val) {
                if (data.user_id == val.member_id) {
                    $thisData = data.members[i]
                    $msg = '<li class="in">';
                        $msg += '<img src=" ' + $thisData.member_avatar + ' " class="avatar" alt="">';
                        $msg += '<div class="message">';
                            $msg += '<span class="arrow"></span>';
                           $msg += ' <a class="name" href="#">'+$thisData.member_name+'</a>';
                            $msg += '<span class="datetime"> at ' + data.dateMessage + '</span>';
                            $msg += '<span class="body"> ' + data.message + ' </span>';
                        $msg += '</div>';
                    $msg += '</li>';
                    $('#chatDiv').append($msg)
                    debateToDownLast();
                }
            });
        }
    });

    socket.on('updateUserStatus', (data) => {
        //console.clear()
        let $userStatusIcon = $('.user-status-icon');
            $userStatusIcon.removeClass('text-success');
            $userStatusIcon.addClass('text-danger');
            $userStatusIcon.attr('title', 'Offline');
        $.each(data, function (key, val) {
            if (val !== null && val !== 0) {
                let $userIcon = $(".user-conected-"+key);
                $userIcon.addClass('text-success');
                $userIcon.removeClass('text-danger');
                $userIcon.attr('title','Online');

            }
        });
    });

    socket.on('sendNewStaffToClient', (data) =>  {
        var langSpecialty = (user_lang == "es") ? data.lang_es:data.lang_en;

        $('#nameStaff'+langSpecialty.replace(' ', '_')).text(data.staff_name)
    });

    socket.on('sendChangeAppStatusToclient', (response) =>  {

        console.log(response)
        if (response.success) {
            $("#recommended-procedure-span").html('')
            $("#recommended-procedure-row").html('')
            $('#status-accepted-modal').modal('hide')

            $("#current-status-p").html(response.status);
            $("#span-status-name").html(response.status);

            hideStatusArea()
        }
        if(response.status_id != 9 ){
            if(response.status_id != 1){
                hideAcdeptedBtn()
            }
        }
        $('#s-recomendatons-indications').html(response.indications)
        $('#s-recomendatons-recomendations').html(response.recomendations)
        $('#s-recomendatons-reazon').remove()

        
        if (response.hasOwnProperty('data')) {
            
            var recommended = `   
                <div class="col-6 mb-2 b-r"> <strong>Procedimiento sugerido: ${response.name}</strong>'
                    <div class="packageDosentExist" id="packageDosentExist">
                        
                    </div>
                    '<br>'
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="recommended-procedure-checkbox">
                        <label class="form-check-label" for="recommended-procedure-checkbox" id="recommended-procedure-span">El paciente acepta el cambio? </label>
                    </div>
                </div>
            `
            var btn = ""
            $("#recommended-procedure-span").html(response.name)
            $("#recommended-procedure-row").html(recommended)
        }

        if (response.exist != null) {
            $('#packageDosentExist').css('display', 'none');
        } else {
            $('packageDosentExist').remove();
            packageWarning(response)
        }

        if (response.hasOwnProperty('datax')) {  
            var data = `
            <div class="suggestionsDosentExist" id="suggestionsDosentExist">
                <div class="alert alert-danger " role="alert">
                    <p>El doctor <strong>${response.doctor}</strong> a sugerido otros procedimientos,</p>   

                        <p>los procedimientos sugeridos son:</p>

                        <ul class="availableSuggestionsList">
                            
                        </ul>
                        <br>
                        <p>por favor espere a que administracion realiza una cotización é informe al paciente sobre los nuevos procedimientos</p> 
                        <br>
                    </div>
                </div>
                <br>
                <div class="form-group form-check mb-auto">
                    <input type="checkbox" class="form-check-input" id="suggestion-procedure-checkbox">
                    <label class="form-check-label" for="suggestion-procedure-checkbox" id="recommended-procedure-span">El paciente acepta la cotización?* </label>
                </div>
            </div>
            `
            $("#recommended-procedure-row").html(data)
        }
        if (response.hasOwnProperty('sugerencia')) {
            surggeriesWaning(response);
        }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('touchstart', function(event) {
            // Verificar si el evento se originó en un elemento de entrada de tipo "file"
            if (event.target && event.target.nodeName === 'INPUT' && event.target.type === 'file') {
                event.preventDefault(); // Cancelar la acción predeterminada
                event.target.click(); // Abrir la galería
            }
        }, { passive: false });
    });
        
</script>
@endsection

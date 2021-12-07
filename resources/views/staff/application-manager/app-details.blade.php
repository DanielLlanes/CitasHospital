@extends('staff.layouts.app')
@section('title')
	@lang('Application Details')
@endsection
@section('content')

@php
echo "<pre>";
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
    array_walk($arrays, function(&$staff) use ($ass, $otro) {
        $id = $staff['id'];
        $staff['name'] = isset($ass[$id]) ? $ass[$id] : null;
        $staff['staff_id'] = isset($otro[$id]) ? $otro[$id] : null;
    });
echo '</pre>';
@endphp


<div class="page-bar">
    <div class="page-title-breadcrumb">
        <div class=" pull-left">
            <div class="page-title">Application Details</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index-2.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li><a class="parent-item" href="#">Application List</a>&nbsp;<i class="fa fa-angle-right"></i>
            </li>
            <li class="active">Application Details</li>
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
                            <img src="http://prado.test/staffFiles/assets/img/user/user.jpg" class="img-responsive" alt="">
                        </div>
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-job"> Patient </div>
                        <div class="profile-usertitle-name"> {{ $appInfo->patient->name }} </div>
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
                            <li class="nav-item tab-all">
                                <a class="nav-link active show" href="#patientData" data-toggle="tab">Patient data</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#services" data-toggle="tab">Services</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#healthData" data-toggle="tab">Health data</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#surgeries" data-toggle="tab">Surgeries</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#medicalHistory" data-toggle="tab">Medical history</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#generalHealthData" data-toggle="tab">General health Data</a>
                            </li>
                            @if ($appInfo->patient->sex != "male")
                                <li class="nav-item tab-all p-l-20">
                                    <a class="nav-link" href="#ghynecologicaldata" data-toggle="tab">Gynecological Data</a>
                                </li>
                            @endif
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#debateChat" data-toggle="tab">Debate</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#timeLine" data-toggle="tab">Time line</a>
                            </li>
                            <li class="nav-item tab-all p-l-20">
                                <a class="nav-link" href="#logisticsNotes" data-toggle="tab">Logistics notes</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="white-box">
                            <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="patientData">
                            <div id="biography" >
                                <div class="row">
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Full name</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Email</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->email }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Phone</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->phone }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->mobile }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Age</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->age }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Date of birth</strong>
                                        <br>
                                        <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->patient->dob)->toFormattedDateString() }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Gender</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->sex }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Address</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->address }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Country</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->country->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>State</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->state->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>City</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->city }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Zip</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->zip }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Emergency contact</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->ecn }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Emergency contact phone</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->patient->ecp }}</p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="services">
                            <div id="biography">
                                <div class="row">
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Brand</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->treatment->brand->brand }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Service</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->treatment->service->service }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Procedure</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->treatment->procedure->procedure }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Package</strong>
                                        <br>
                                        <p class="text-muted">{{ (is_null($appInfo->treatment->package) ? " ----- ": $appInfo->treatment->package->package) }}</p>
                                    </div>
                                </div>
                                @if (count($appInfo->images) > 0)
                                    Image area
                                    <div class="row">
                                        images area
                                    </div>
                                @endif

                                <hr>
                                <div class="row">
                                    <div class="col-12 mb-2 b-r text-center">
                                        <strong>
                                            Assigned staff
                                        </strong>
                                    </div>
                                    
                                   @php 
                                       foreach ($arrays as $value) {
                                            Auth::guard('staff')->user()->id;
                                           echo '<div class="col-md-3 col-6 mb-2 b-r text-center"> <strong>'.$value['specialty'].'</strong>';
                                           echo '<br>';
                                           $staff_name = is_null($value['name']) ? "": $value['name'];
                                           $staff_id = is_null($value['id']) ? "": $value['id'];
                                           if ($staff_name == "") {echo "<br>";}
                                           echo '<p class="text-muted" id="nameStaff'.$value['specialty'].'">'.$staff_name.'</p>';
                                           if ($value['id'] == 10) {
                                              if (Auth::guard('staff')->user()->can('applications.changeCoordinator')) {
                                                   echo '<button type="button" id="appChange'.$value['specialty'].'" service="'.$appInfo->id.'" class="btn btn-success">Assing / Change '.$value['specialty'].'</button>';
                                               } 
                                           } else {
                                                if (Auth::guard('staff')->user()->can('applications.changeStaff')) {
                                                     echo '<button type="button" id="appChange'.$value['specialty'].'" service="'.$appInfo->id.'" class="btn btn-success">Assing / Change '.$value['specialty'].'</button>';
                                                 } 
                                           }
                                           echo '</div>';
                                       }
                                   @endphp
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="healthData">
                            <div id="biography">
                                <div class="row">
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Measurement system</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->mesure_sistem == 'I') ? 'Imperial': 'Metric' }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Max weigth {{ ($appInfo->mesure_sistem == 'I') ? '(Lb)': '(Kg)' }}</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->max_weigh }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Current weigth {{ ($appInfo->mesure_sistem == 'I') ? '(Lb)': '(Kg)' }}</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->weight }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2 b-r"> <strong>Heigth {{ ($appInfo->mesure_sistem == 'I') ? '(Ft)': '(Mts)' }}</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->height }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>IMC</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->imc }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>medications / drugs</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->if_take_medication == 0)? "No":"Yes" }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Blood-thinners</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->if_take_blood_thinners == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->if_take_blood_thinners == 1)
                                        <div class="col-md-3 col-6 mb-2"> <strong>Explain the reason</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->razon_blood_thinners }}</p>
                                        </div>
                                    @endif
                                    @if (count($appInfo->medications) > 0)
                                        <div class="col-md-12"> <strong>Medications</strong>
                                            <br>
                                            <div class="table-wrap">
                                                <div class="table-responsive">
                                                    <table class="table display treatment-overview mb-30" id="support_table">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Name</th>
                                                                <th>Reason</th>
                                                                <th>Dosage</th>
                                                                <th>Frecuency</th>
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
                                    <div class="col-md-3 col-6 mb-2"> <strong>Acid reflux?</strong>
                                        <br>
                                        <p class="text-muted">{{ $appInfo->acid_reflux }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Penicillin allergy</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->penicilin == 0)? 'No':'Yes' }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Sulfa drugs</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->drugs_sulfa == 0)? 'No':'Yes' }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Iodine allergy</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->iodine == 0)? 'No':'Yes' }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Latex allergy</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->latex == 0)? 'No':'Yes' }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Tape allergy</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->tape == 0)? 'No':'Yes' }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Aspirin allergy</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->aspirin == 0)? 'No':'Yes' }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Other allergy</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->other_allergy == 0)? 'No':'Yes' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="surgeries">
                            <div id="biography">
                                <div class="row">
                                    <div class="col-md-3 col-6 mb-2"> <strong>Surgeries</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->if_have_surgeries == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if (count($appInfo->surgeries) > 0)
                                        <div class="col-md-12"> <strong>Surgeries</strong>
                                            <br>
                                            <div class="table-wrap">
                                                <div class="table-responsive">
                                                    <table class="table display treatment-overview mb-30" id="support_table">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Type</th>
                                                                <th>Name</th>
                                                                <th>Age</th>
                                                                <th>Year</th>
                                                                <th>Complications</th>
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
                                    <div class="col-md-3 col-6 mb-2"> <strong>Addiction</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->addiction == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->addiction == 1)
                                        <div class="col-md-3 col-6 mb-2"> <strong>Which one</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->which_one_adiction}}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-6 mb-2"> <strong>High lipid levels</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->high_lipid_levels == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->high_lipid_levels == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_high_lipd_levels)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->high_lipid_levels_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Arthritis</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->arthritis == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->arthritis == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_arthritis)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->arthritis_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Cancer</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->cancer == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->cancer == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_cancer)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->cancer_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Cholesterol</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->cholesterol == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->cholesterol == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_cholesterol)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->cholesterol_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Triglycerides</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->triglycerides == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->triglycerides == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_triglycerides)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->triglycerides_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Stroke</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->disease_stroke == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->disease_stroke == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_stroke)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->disease_stroke_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Diabetes</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->diabetes == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->diabetes == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_diabetes)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->diabetes_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Coronary artery disease</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->coronary_artery_disease == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->coronary_artery_disease == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_coronary_artery_disease)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->coronary_artery_disease_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Liver disease</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->disease_liver == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->disease_liver == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_liver)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->disease_liver_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Lugn disease</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->disease_lung == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->disease_lung == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_lungs)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->disease_lung_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Renal disease</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->disease_renal == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->disease_renal == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_renal)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->disease_renal_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Thyroid disease</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->disease_thyroid == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->disease_thyroid == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_disease_thyroid)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->disease_thyroid_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Hypertension</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->ypertension == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->ypertension == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Diagnostic date</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->date_hypertension)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->hypertension_treatment }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-6 mb-2"> <strong>Any other illnesses</strong>
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
                                                                <th>Illness</th>
                                                                <th>Diagnostic Date</th>
                                                                <th>Treatment</th>
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
                                    <div class="col-md-4 col-6 mb-2"> <strong>Smoke cigarettes</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->smoke == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->smoke == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Amount</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->smoke_cigars }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Treatment</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->smoke_years }}</p>
                                        </div>
                                    @endif
                                    @if ($appInfo->smoke == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Quit smoking</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->stop_smoking == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->stop_smoking == 1)
                                            <div class="col-md-4 col-6 mb-2"> <strong>How long</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->smoke_years }}</p>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-6 mb-2"> <strong>Drink alcohol</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->alcohol == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->alcohol == 1)
                                        <div class="col-md-4 col-6 mb-2"> <strong>Volume of alcohol (frecuency)</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->volumen_alcohol }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-6 mb-2"> <strong>Use recreational drugs?</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->recreative_drugs == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->recreative_drugs == 1)
                                        <div class="col-md-3 col-6 mb-2"> <strong>Amount of Drugs (Pills)</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->total_recreative_drugs }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Use Intravenous Drugs</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->intravenous_drugs == 0)? "No":"Yes" }}</p>
                                        </div>
                                    @endif
                                    @if ($appInfo->intravenous_drugs == 1)
                                        <div class="col-md-3 col-6 mb-2"> <strong>Description of intravenous drugs</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->description_intravenous_drugs }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-6 mb-2"> <strong>Easily fatigued</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->fatigue == 0)? "No":"Yes" }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Shortness of breath</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->trouble_breathe == 0)? "No":"Yes" }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Asthma</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->asthma == 0)? "No":"Yes" }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Use a B-PAP or C-PAP while you sleep</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->bipap_cpap == 0)? "No":"Yes" }}</p>
                                    </div>
                                    <div class="col-md-3 col-6 mb-2"> <strong>Exercise</strong>
                                        <br>
                                        <p class="text-muted">{{ ($appInfo->exercise == 0)? "No":"Yes" }}</p>
                                    </div>
                                    @if ($appInfo->exercise == 1)
                                        <div class="col-md-12"> <strong>Exercise</strong>
                                            <br>
                                            <div class="table-wrap">
                                                <div class="table-responsive">
                                                    <table class="table display treatment-overview mb-30" id="support_table">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>type</th>
                                                                <th>How long</th>
                                                                <th>Frecuency</th>
                                                                <th>Hour per day</th>
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
                                        <div class="col-md-3 col-6 mb-2"> <strong>Hours sleep at night</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->hours_you_sleep_at_night }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Take sleeping pills</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->do_you_take_sleeping_pills == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Suffer from anxiety or depression</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->do_you_suffer_from_anxiety_or_depression == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Take pills for anxiety or depression</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->do_you_take_pills_for_anxiety_or_depression == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2"> <strong>Feel under stress</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->exercise == 0)? "No":"Yes" }}</p>
                                        </div>
                                    @endif
                                </div>
                                @if ($appInfo->treatment->service_id == 3 && $appInfo->patient->sex == "male")
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Have erections at the morning</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->do_you_have_erections_at_the_morning == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->do_you_have_erections_at_the_morning == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>How many per week</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->how_many_per_week }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Have problems getting erection</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->do_you_have_erections_at_the_morning == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->do_you_have_erections_at_the_morning == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>Since when</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->since_when }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Describe</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->describe_your_erection_problem }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Hhave problems maintaining an erection</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->do_you_have_problems_maintaining_an_erection == 0)? "No":"Yes" }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Take any natural remedy for Erectile dysfunction</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->do_you_take_any_natural_remedy_for_erectile_dysfunction == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->do_you_take_any_natural_remedy_for_erectile_dysfunction == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>What kind</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->what_kind }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>How did it work</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->how_did_it_work_natural_remedy }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Where do I get them from</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->where_did_you_get_them }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Has medication been injected for dysfunction erectile</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->has_medication_been_injected_for_dysfunction_erectile == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->has_medication_been_injected_for_dysfunction_erectile == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>How many times</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->how_many_times_have_injected }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>How did it work</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->how_did_it_work }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Have had an erection longer than 6 hours</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->have_you_had_an_erection_longer_than_six_hours == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->have_you_had_an_erection_longer_than_six_hours == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>When</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->when_you_had_a_six_hours_erection }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>How was it resolved</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->how_was_it_resolved }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Did get medical attention</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->did_you_get_medical_attention }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2"> <strong>Suffer from penile curvature</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->do_you_suffer_from_penile_curvature == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->do_you_suffer_from_penile_curvature == 1)
                                            <div class="col-md-3 col-6 mb-2"> <strong>How intense</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->how_intense }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Which direction</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->which_direction }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Does it hurt</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->does_it_hurt }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2"> <strong>Does it prevent intercourse</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->does_it_prevent_intercourse }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-6 mb-2"> <strong>Has PRP been injected for erectile dysfunction</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->has_prp_been_injected_for_erectile_dysfunction == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Have you received stem cell treatment for erectile dysfunction</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->have_you_received_stem_cell_treatment_for_erectile_dysfunction == 0)? "No":"Yes" }}</p>
                                        </div>
                                        <div class="col-md-4 col-6 mb-2"> <strong>Have you received vascular regeneration therapy with low intensity wave therapy for erectile dysfunction?</strong>
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
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Date of last menstrual period</strong>
                                            <br>
                                            <p class="text-muted">{{ Carbon\Carbon::parse($appInfo->last_menstrual_period)->toFormattedDateString() }}</p>
                                        </div>
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Bleeding was</strong>
                                            <br>
                                            <p class="text-muted">{{ $appInfo->bleeding_whas }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Have been pregnant</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->have_you_been_pregnant == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->have_you_been_pregnant == 1)
                                            <div class="col-md-3 col-6 mb-2 b-r"> <strong>How many times</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->how_many_times }}</p>
                                            </div>
                                            <div class="col-md-3 col-6 mb-2 b-r"> <strong>C-section</strong>
                                                <br>
                                                <p class="text-muted">{{ $appInfo->c_section }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mb-2 b-r"> <strong>Use any type of birth control</strong>
                                            <br>
                                            <p class="text-muted">{{ ($appInfo->birth_control == 0)? "No":"Yes" }}</p>
                                        </div>
                                        @if ($appInfo->birth_control == 1)
                                            <div class="col-md-12"> <strong>Birth control</strong>
                                                <br>
                                                <div class="table-wrap">
                                                    <div class="table-responsive">
                                                        <table class="table display treatment-overview mb-30" id="support_table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>type</th>
                                                                    <th>How long</th>
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
                                    <div class="col-12 col-md-4">
                                        <div class="card card-box">
                                            <div class="card-head">
                                                <header>STAFF</header>
                                            </div>
                                            <div class="card-body no-padding height-9" id="listChat">
                                                <div class="">
                                                    <ul class="list-unstyled"></ul>
                                                        @foreach ($appInfo->assignments as $item)
                                                            @foreach($item->specialties as $specialty)
                                                                <p class="p-0 mb-0"><strong>{{ $specialty->name }}</strong></p>
                                                                
                                                                <p class="p-0 mt-0">{{ $item->name }}</p>
                                                            @endforeach
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <div class="card card-box">
                                            <div class="card-head">
                                                <header>DEBATE</header>
                                            </div>
                                            <div class="card-body no-padding height-9">
                                                <div class="row">
                                                    <ul class="chat nice-chat small-slimscroll-style" id="chatDiv">
                                                        <li class="in">
                                                            <img src="{{ asset( auth()->guard('staff')->user()->avatar )}}" class="avatar" alt="">
                                                            <div class="message">
                                                                <span class="arrow"></span>
                                                                <a class="name" href="#">Jone Doe</a>
                                                                <span class="datetime">at Mar 12, 2014 6:12</span>
                                                                <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit </span>
                                                            </div>
                                                        </li>
                                                        <li class="out">
                                                            <img src="../assets/img/dp.jpg" class="avatar" alt="">
                                                            <div class="message">
                                                                <span class="arrow"></span>
                                                                <a class="name" href="#">Dr. Emily Patel</a>
                                                                <span class="datetime">at Mar 12, 2014 6:13</span>
                                                                <span class="body"> sed diam nonummy nibh euismod tincidunt ut </span>
                                                            </div>
                                                        </li>
                                                        <li class="in">
                                                            <img src="../assets/img/doc/doc1.jpg" class="avatar" alt="">
                                                            <div class="message">
                                                                <span class="arrow"></span>
                                                                <a class="name" href="#">Jone Doe</a>
                                                                <span class="datetime">at Mar 12, 2014 6:12</span>
                                                                <span class="body"> aoreet dolore magna aliquam erat volutpat. </span>
                                                            </div>
                                                        </li>
                                                        <li class="out">
                                                            <img src="../assets/img/dp.jpg" class="avatar" alt="">
                                                            <div class="message">
                                                                <span class="arrow"></span>
                                                                <a class="name" href="#">Dr. Emily Patel</a>
                                                                    <span class="datetime">at Mar 12, 2014 6:13</span>
                                                                    <span class="body"> sed diam nonummy nibh euismod tincidunt ut </span>
                                                            </div>
                                                        </li>
                                                        <li class="in">
                                                            <img src="../assets/img/doc/doc1.jpg" class="avatar" alt="">
                                                            <div class="message">
                                                                <span class="arrow"></span>
                                                                    <a class="name" href="#">Jone Doe</a>
                                                                    <span class="datetime">at Mar 12, 2014 6:12</span>
                                                                    <span class="body"> aoreet dolore magna aliquam erat volutpat. </span>
                                                            </div>
                                                        </li>
                                                        <li class="out"><img src="../assets/img/dp.jpg" class="avatar" alt="">
                                                            <div class="message">
                                                                <span class="arrow"></span> <a class="name" href="#">Dr. Emily
                                                                    Patel</a> <span class="datetime">at Mar 12, 2014 6:13</span> <span class="body"> sed diam nonummy nibh </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="box-footer chat-box-submit">
                                                        <div class="input-group">
                                                            <input type="text" name="message" placeholder="Enter your ToDo List" class="form-control">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-warning btn-flat"><i class="fa fa-arrow-right"></i></button>
                                                            </span>
                                                        </div>
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
                                                <textarea class="form-control p-text-area" rows="4" placeholder="Add time line notes"></textarea>
                                            </form>
                                            <footer class="panel-footer">
                                                <button class="btn btn-post pull-right">Post</button>
                                                <ul class="nav nav-pills p-option">
                                                    <li>
                                                        <a href="#"><i class="fa fa-user"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-camera"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa  fa-location-arrow"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-meh-o"></i></a>
                                                    </li>
                                                </ul>
                                            </footer>
                                        </div>
                                    </div>
                                    <div class="full-width p-l-20">
                                        <ul class="activity-list">
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset("staffFiles/assets/img/user/user.jpg") }}" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Rajesh</a> <span>Uploaded 3 new photos</span></h5>
                                                    <p class="text-muted">7 minutes ago near Alaska, USA</p>
                                                    <div class="album">
                                                        <a href="#">
                                                            <img alt="" src="https://www.orliman.com/wp-content/uploads/post13042017_quirofano-inteligente.jpg">
                                                        </a>
                                                        <a href="#">
                                                            <img alt="" src="https://2.bp.blogspot.com/-KN8x77y7Qx4/TrMHGh9BUCI/AAAAAAAAD5M/rqTY3ZmwrIs/w1200-h630-p-k-no-nu/Imagen+or1.jpg">
                                                        </a>
                                                        <a href="#">
                                                            <img alt="" src="https://i0.wp.com/yoamoenfermeriablog.com/wp-content/uploads/2018/10/quirofano_moncloa1_15_1000x564.jpg?resize=790%2C446&ssl=1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset("staffFiles/assets/img/user/user.jpg") }}" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">John Doe</a> <span>attended a meeting with</span>
                                                                    <a href="#">Lina Smith.</a></h5>
                                                    <p class="text-muted">2 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset("staffFiles/assets/img/user/user.jpg") }}" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Kehn Anderson</a> <span>completed the task “wireframe design” within the dead line</span></h5>
                                                    <p class="text-muted">4 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset("staffFiles/assets/img/user/user.jpg") }}" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Jacob Ryan</a> <span>was absent office due to sickness</span></h5>
                                                    <p class="text-muted">4 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i> 13 minutes ago</span>
                                            <div class="post-img"><img src="https://previews.123rf.com/images/siraphol/siraphol1704/siraphol170400471/75206739-interior-borroso-abstracto-del-hospital-y-de-la-cl%C3%ADnica-para-el-fondo.jpg" class="img-responsive" alt=""></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i> Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                         <div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i> 37 minutes ago</span>
                                            <div class="post-img"><img src="https://i.pinimg.com/originals/cf/ac/ce/cfaccef0c3c98b6d6405d1f4c16ccc8f.jpg" class="img-responsive" alt=""></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i> Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                         <div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i> 53 minutes ago</span>
                                            <div class="post-img"><img src="https://i.pinimg.com/originals/cf/ac/ce/cfaccef0c3c98b6d6405d1f4c16ccc8f.jpg" class="img-responsive" alt=""></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i> Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 p-t-20 text-center">
                                              <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-info">Load More</button>
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
                                                <textarea class="form-control p-text-area" rows="4" placeholder="Add logistics notes"></textarea>
                                            </form>
                                            <footer class="panel-footer">
                                                <button class="btn btn-post pull-right">Post</button>
                                                <ul class="nav nav-pills p-option">
                                                    <li>
                                                        <a href="#"><i class="fa fa-user"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-camera"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa  fa-location-arrow"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fa fa-meh-o"></i></a>
                                                    </li>
                                                </ul>
                                            </footer>
                                        </div>
                                    </div>
                                    <div class="full-width p-l-20">
                                        <ul class="activity-list">
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset("staffFiles/assets/img/user/user.jpg") }}" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Rajesh</a> <span>Uploaded 3 new photos</span></h5>
                                                    <p class="text-muted">7 minutes ago near Alaska, USA</p>
                                                    <div class="album">
                                                        <a href="#">
                                                            <img alt="" src="https://www.orliman.com/wp-content/uploads/post13042017_quirofano-inteligente.jpg">
                                                        </a>
                                                        <a href="#">
                                                            <img alt="" src="https://2.bp.blogspot.com/-KN8x77y7Qx4/TrMHGh9BUCI/AAAAAAAAD5M/rqTY3ZmwrIs/w1200-h630-p-k-no-nu/Imagen+or1.jpg">
                                                        </a>
                                                        <a href="#">
                                                            <img alt="" src="https://i0.wp.com/yoamoenfermeriablog.com/wp-content/uploads/2018/10/quirofano_moncloa1_15_1000x564.jpg?resize=790%2C446&ssl=1">
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset("staffFiles/assets/img/user/user.jpg") }}" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">John Doe</a> <span>attended a meeting with</span>
                                                                    <a href="#">Lina Smith.</a></h5>
                                                    <p class="text-muted">2 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset("staffFiles/assets/img/user/user.jpg") }}" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Kehn Anderson</a> <span>completed the task “wireframe design” within the dead line</span></h5>
                                                    <p class="text-muted">4 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="avatar">
                                                    <img src="{{ asset("staffFiles/assets/img/user/user.jpg") }}" alt="" />
                                                </div>
                                                <div class="activity-desk">
                                                    <h5><a href="#">Jacob Ryan</a> <span>was absent office due to sickness</span></h5>
                                                    <p class="text-muted">4 days ago near Alaska, USA</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i> 13 minutes ago</span>
                                            <div class="post-img"><img src="https://previews.123rf.com/images/siraphol/siraphol1704/siraphol170400471/75206739-interior-borroso-abstracto-del-hospital-y-de-la-cl%C3%ADnica-para-el-fondo.jpg" class="img-responsive" alt=""></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i> Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                        <div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i> 37 minutes ago</span>
                                            <div class="post-img"><img src="https://i.pinimg.com/originals/cf/ac/ce/cfaccef0c3c98b6d6405d1f4c16ccc8f.jpg" class="img-responsive" alt=""></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i> Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                        <div class="post-box"> <span class="text-muted text-small"><i class="fa fa-clock-o" aria-hidden="true"></i> 53 minutes ago</span>
                                            <div class="post-img"><img src="https://i.pinimg.com/originals/cf/ac/ce/cfaccef0c3c98b6d6405d1f4c16ccc8f.jpg" class="img-responsive" alt=""></div>
                                            <div>
                                                <h4 class="">Lorem Ipsum is simply dummy text of the printing</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
                                                <p> <a href="#" class="btn btn-raised btn-info btn-sm"><i class="fa fa-heart-o" aria-hidden="true"></i> Like (5) </a> <a href="#" class="btn btn-raised bg-soundcloud btn-sm"><i class="zmdi zmdi-long-arrow-return"></i> Reply</a> </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 p-t-20 text-center">
                                              <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-info">Load More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                echo '<div class="modal fade" id="change'.$value['specialty'].'App" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <select class="form-control input-height" id="getStaff'.$value['specialty'].'">
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
            echo '<div class="modal fade" id="change'.$value['specialty'].'App" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <select class="form-control input-height" id="getStaff'.$value['specialty'].'">
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
<datalist id="valAutocomplete">
    @foreach($cordinators as $coordinator)
        <option  value="{{ $coordinator->name }}"></option>
    @endforeach
</datalist>
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

<script>
    $('.table').magnificPopup({
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
    var globalRouteSetNewStaff = "{{ route('staff.applications.setNewStaff') }}";
    var globalRouteGetNewStaff = "{{ route('staff.applications.getNewStaff') }}";

    var chatDiv = document.getElementById("chatDiv");
    var panelDerecha = document.getElementById("PanelDerecha");

    $("#listChat").height($("#chatDiv").height()+34)

    $(document).on('click', '[id^="appChange"]', function(event) {
        event.preventDefault();
        var specialty = $(this).attr('id').split("appChange")
        //console.log("specialty", specialty[1]);
        $('#change'+specialty[1]+"App").on('show.bs.modal', function (e) {
            $('#getStaff'+specialty[1]).select2({
                dropdownParent: $('#change'+specialty[1]+"App"),
                placeholder: "Select click here",
                ajax: {
                    url: globalRouteGetNewStaff,
                    type: 'post',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term, 
                            specialty: specialty[1],
                            app: {{ $appInfo->id }},
                        }
                    },
                    processResults: function(data) {
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
              var lastValue = $.trim(e.currentTarget.value);
              var lastText = e.currentTarget.textContent;
              setNewStaff(lastValue, lastText, specialty[1])
             });
        }).modal('show');
    });

    function setNewStaff(lastValue, lastText, specialty)
    {
        var form_data = new FormData();
        form_data.append('name', lastText);
        form_data.append('id', lastValue);
        form_data.append('app', '{{ $appInfo->id }}');
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
            success:function(data)
            {
                $('#nameStaff'+specialty).text(data.name)
                $('#change'+specialty+"App").modal('hide')
            },
            complete: function()
            {
            },
        })
    }
</script>
@endsection

<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Mail\NewEventPatient;
use App\Mail\NewEventStaff;
use App\Models\Site\Application;
use App\Models\Staff\Event;
use App\Models\Staff\Patient;
use App\Models\Staff\Staff;
use App\Traits\DatesLangTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    use DatesLangTrait;

    public function __construct()
    {
        $this->middleware('auth:staff');
        $this->middleware('can:calendar.list')->only(['eventSources', 'index']);
        $this->middleware('can:calendar.create')->only(['create','store']);
        $this->middleware('can:calendar.edit')->only(['edit','update', 'eventDrop']);
        $this->middleware('can:calendar.destroy')->only(['destroy']);
        date_default_timezone_set('America/Tijuana');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        
        $events = Event::with(
            [
                'staff',
                'patient'
            ]
        )
        ->get();
        return view('staff.events-manager.list');
    }

    public function eventSources()
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $events = Event::with(
            [
                'staff',
                'patient',
                'application' => function($q) use($lang) {
                    $q->with(
                        [
                            'treatment' => function($q) use($lang) {
                                $q->with(
                                    [
                                        "brand" => function($q){
                                            $q->select("brand", "id", "color");
                                        },
                                        "service" => function($q) use($lang) {
                                            $q->select("service_$lang AS service", "id");
                                        },
                                        "procedure" => function($q) use($lang) {
                                            $q->select("procedure_$lang AS procedure", "id");
                                        },
                                        "package" => function($q) use($lang) {
                                            $q->select("package_$lang AS package", "id");
                                        },
                                    ]
                                );
                            },
                        ]
                    );
                }
            ]
        )
        ->get();
        $allEvents = [];
        $singleEvent = [];
        $extendedProps = [];
        for ($i = 0; $i < count($events); $i++)
        {

            $singleEvent['id'] = $events[$i]->id;
            $singleEvent['backgroundColor'] = 'linear-gradient(70deg,'.$events[$i]->staff->color.' 90%, '.(!is_null($events[$i]->is_application)? $events[$i]->application->treatment->brand->color : $events[$i]->staff->color).' 10%)';
            $singleEvent['borderColor'] = $events[$i]->staff->color;
            $singleEvent['title'] = $events[$i]->title;
            $singleEvent['start'] = $events[$i]->start_date.'T'.$events[$i]->start_time;
            $singleEvent['end'] = $events[$i]->start_date.'T'.$events[$i]->end_time;
            $singleEvent['allDay'] = false;
            $extendedProps['staff'] = $events[$i]->staff->name;
            $extendedProps['staff_id'] = $events[$i]->staff->id;
            $extendedProps['patient'] = $events[$i]->patient->name;
            $extendedProps['patient_id'] = $events[$i]->patient->id;
            $extendedProps['notas'] = $events[$i]->note;
            $extendedProps['email'] = $events[$i]->patient->email;
            $extendedProps['lang'] = $events[$i]->patient->lang;
            $extendedProps['phone'] = $events[$i]->patient->phone;
            $extendedProps['startDate'] = $events[$i]->start_date;
            $extendedProps['startTime'] = $events[$i]->start_time;;
            $extendedProps['endDate'] = $events[$i]->start_date;
            $extendedProps['endTime'] = $events[$i]->end_time;

            $extendedProps['isapp'] = (!is_null($events[$i]->is_application)? "si":'no');
            $extendedProps['application_id'] = (!is_null($events[$i]->is_application)? $events[$i]->application_id : '0');
            $extendedProps['application_brand'] = (!is_null($events[$i]->is_application)? $events[$i]->application->treatment->brand->brand:'no');
            $extendedProps['application_service'] = (!is_null($events[$i]->is_application)? $events[$i]->application->treatment->service->service:'no');
            $extendedProps['application_procedure'] = (!is_null($events[$i]->is_application)? $events[$i]->application->treatment->procedure->procedure:'no');
            $data = 'no';
            if (!is_null($events[$i]->is_application) && !is_null($events[$i]->application->treatment->package)) {
                $data = $events[$i]->application->treatment->package->package;
            }
            $extendedProps['application_package'] = $data;
            $extendedProps['formatedDate'] = $this->datesLangTrait($events[$i]->start_date, Auth::guard('staff')->user()->lang);

            $singleEvent['extendedProps'] = $extendedProps;
            $allEvents[] = $singleEvent;
        }
        return response()->json($allEvents);
    }

    public function eventDrop(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $event = Event::find($request->id);
        if ($event) {
            $date = explode( 'T', $request->start );
            $event->start_date = $date[0];
            if ($event->save()) {
               return response()->json(
                   [
                       'icon' => 'success',
                       'msg' => Lang::get('Event edited successfully!'),
                       'reload' => true
                   ]
               );
            }
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The event you are trying to edit does\'t exist or was previously edited!'),
                'reload' => false
            ]
        );
    }

    public function store(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        if ($request->patient_id == 'undefined') {unset($request['patient_id']);}
        if ($request->app == 'undefined') {unset($request['app']);}
        if ($request->isApp == '0') {unset($request['isApp']);}
        $todayDate = Date('Y-m-d');
        $validator = Validator::make($request->all(), [
            'patient' => 'required|string',
            'patient_id' => 'sometimes|nullable|integer|exists:patients,id',
            'email' => 'required|email',
            'start' => 'required|date_format:Y/m/d|after_or_equal:'.$todayDate,
            'timeStart' => 'required|date_format:H:i',
            'timeEnd' => 'required|after_or_equal:timeStart|date_format:H:i',
            'notes' => 'required|string',
            'lang' => 'required|string|max:2',
            'title' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'staff' => 'required|string',
            'app' => [
                ($request->has('isApp') ? 'required': ''),
                ($request->has('isApp') ? 'exists:applications,id': ''),
                ($request->has('isApp') ? 'integer': ''),
            ],
            'phone' => ['required','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i']
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $patient_id = $request->patient_id;
        if ($request->has('patient_lang')) {
            $patient_lang = $request->lang;
        } else {
            $patient_lang = $lang;
        }

        $patienExist = Patient::where('email', $request->email)->first();
        if (!$patienExist) {
            $patient = New Patient;
            $patient->name = $request->patient;
            $patient->email = $request->email;
            $patient->phone = $request->phone;
            $patient->lang = $lang;
            $patient->code = time().uniqid(Str::random(30));
            $patient->password = Hash::make(Str::random(10));
            $patient->save();
            $patient_id = $patient->id;

        }

        $event = new Event;
        $event->staff_id = $request->staff_id;
        $event->patient_id = $patient_id;
        $event->title = $request->title;
        $event->start_date = $request->start;
        $event->start_time = $request->timeStart;
        $event->end_date = $request->start;
        $event->end_time = $request->timeEnd;
        $event->note = $request->notes;
        $event->title = $request->title;
        $event->code = time().uniqid(Str::random(30));
        $event->application_id = $request->has('isApp') ? $request->app: null;
        $event->is_application = $request->has('isApp') ? $request->isApp: null;

        if ($event->save()) {
            $staffData = Staff::findOrFail($request->staff_id);
            $dateD = $this->datesLangTrait ($event->start_date, $staffData->lang);
            $dateP = $this->datesLangTrait ($event->start_date, $request->lang);

            $dataMsg = array(
                'doctor_email' => $staffData->email,
                'doctor_name' => $staffData->name,
                'doctor_lang' => $staffData->lang,
                'doctor_subj' => "A new appointment has been scheduled",
                'doctor_date' => $dateD,
                'doctor_body'  => "Hello, a new appointment has been scheduled with :patient_name, please write down the details",

                'patient_name' => $request->patient,
                'patient_mail' => $request->email,
                'patient_lang' => $request->lang,
                'patient_subj' => "Your medical appointment has been confirmed",
                'patient_date' => $dateP,
                'patient_body' => "Hello, your medical appointment with :doctor_name has been scheduled, please write down the details",

                'date' => $request->start,
                'hour_to' => $request->timeStart,
                'hour_from' => $request->timeEnd,

                'note' => $request->notes
            );

            if (!is_null($event->application_id) ) {
                DB::table('application_status')->insert([
                    'application_id' => $event->application_id,
                    'status_id' => "6",
                    'code' => time().uniqid(Str::random(30)),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            


            Mail::send(new NewEventPatient($dataMsg));
            Mail::send(new NewEventStaff($dataMsg));

            app()->setLocale($lang);
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Event created successfully!'),
                    'reload' => true
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the event please try again!'),
                'reload' => false
            ]
        );
    }

    public function update(Request $request)
    {

        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $todayDate = Date('Y-m-d');
        $event = Event::find($request->event);
        if ($request->app == 'undefined') {unset($request['app']);}
        if ($request->isApp == '0') {unset($request['isApp']);}
        if ($event) {
            $validator = Validator::make($request->all(), [
                'patient' => 'required|string',
                'patient_id' => 'sometimes|integer|exists:patients,id',
                'email' => 'required|email',
                'lang' => 'required|string|max:2',
                'start' => 'required|date_format:Y/m/d|after_or_equal:'.$todayDate,
                'timeStart' => 'required|date_format:H:i',
                'timeEnd' => 'required|after_or_equal:timeStart|date_format:H:i',
                'notes' => 'required|string',
                'title' => 'required|string',
                'staff_id' => 'required|exists:staff,id',
                'staff' => 'required|string',
                'app' => [
                    ($request->has('isApp') ? 'required': ''),
                    ($request->has('isApp') ? 'exists:applications,id': ''),
                    ($request->has('isApp') ? 'integer': ''),
                ],
                'phone' => ['required','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i']
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }
            $event->staff_id = $request->staff_id;
            $event->patient_id = $request->patient_id;
            $event->title = $request->title;
            $event->start_date = $request->start;
            $event->start_time = $request->timeStart;
            $event->end_date = $request->start;
            $event->end_time = $request->timeEnd;
            $event->note = $request->notes;
            $event->title = $request->title;
            $event->code = time().uniqid(Str::random(30));
            $event->application_id = $request->has('isApp') ? $request->app: null;
            $event->is_application = $request->has('isApp') ? $request->isApp: null;

            if ($event->save()) {
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => Lang::get('Event edited successfully!'),
                        'reload' => true
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The event you are trying to edit does\'t exist or was previously edited!'),
                    'reload' => false
                ]
            );
        }

    }

    public function destroy(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $event = Event::find($request->id);
        if($event->exists()){
            $event->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Event successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Event you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }

    public function getApps(Request $request)
    {

        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $applications = Application::with(
                [
                    'payments',
                    'patient' => function($q){
                        $q->select('name', 'id');
                    },
                    'treatment' => function($q) use($lang) {
                        $q->with(
                            [
                                "brand" => function($q){
                                    $q->select("brand", "id", "color");
                                },
                                "service" => function($q) use($lang) {
                                    $q->select("service_$lang AS service", "id");
                                },
                                "procedure" => function($q) use($lang) {
                                    $q->select("procedure_$lang AS procedure", "id");
                                },
                                "package" => function($q) use($lang) {
                                    $q->select("package_$lang AS package", "id");
                                },
                            ]
                        );
                    },
                    'assignments' => function($q) use($lang) {
                        $q->whereHas(
                            'specialties', function($q){
                                $q->where("name_en", "Coordination");
                            }
                        );
                    }
                ]
            )
            ->where('is_complete', 1)
            ->where('patient_id', $request->id)
            ->get();


            foreach ($applications as $i =>$app) {
                if (count($app->payments) == 0) {
                    $applications->forget($i);
                }
            }


            return DataTables::of($applications)
                ->addIndexColumn()
                ->addColumn('action', function($applications){
                    $brand = $applications->treatment->brand->brand;
                    $service = $applications->treatment->service->service;
                    $procedure = $applications->treatment->procedure->procedure;
                    $package = $applications->treatment->package->package;
                    return '<button type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect margin-right-10 btn-primary btn-add" style="height: 36px; min-width: 36px;width: 36px;" name="'.$brand.', '.$service.', '.$procedure.', '.$package.'" data-id=" '.$applications->id.' "><i class="material-icons">add</i></button>';
                })
                ->addColumn('treatment', function($applications){
                    $brand = $applications->treatment->brand->brand;
                    $service = $applications->treatment->service->service;
                    $procedure = $applications->treatment->procedure->procedure;
                    $package = $applications->treatment->package->package;
                    return '<span style="font-weight: 500;">'.$brand.', '.$service.', '.$procedure.', '.$package.'</span>';
                })
                ->addColumn('date', function($applications){
                    return '<span style="font-weight: 500;">'.$applications->created_at->toDayDateTimeString().'</span>';
                })
                ->addColumn('code', function($applications){
                    return '<span style="font-weight: 500;">'.$applications->temp_code.'</span>';
                })
                ->rawColumns(
                    [
                        'DT_RowIndex',
                        'action',
                        'treatment',
                        'date',
                        'code'
                    ]
                )
            ->make(true);
        }
    }
}

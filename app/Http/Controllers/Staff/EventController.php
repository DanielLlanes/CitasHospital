<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Mail\NewEventPatient;
use App\Mail\NewEventStaff;
use App\Models\Site\Application;
use App\Models\Staff\Event;
use App\Models\Staff\Patient;
use App\Models\Staff\Staff;
use App\Models\Staff\Status;
use App\Models\Staff\Treatment;
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
    public function index()
    {        
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $status = Status::select('id', 'color', "name_$lang as name")->where('type', 'Event')->get();

        $events = Event::with(
            [
                'staff',
                'patient',
                'statusOne' => function($q)use($lang){
                    $q->with([
                        'status' => function($q)use($lang){
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ]);
                },
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

            if (!is_null($events[$i]->statusOne)) {
                $singleEvent['backgroundColor'] = $events[$i]->statusOne->status->color;
                $singleEvent['borderColor'] = $events[$i]->statusOne->status->color;
            } else {
                if (!is_null( $events[$i]->staff_id)) {
                    $singleEvent['backgroundColor'] = 'linear-gradient(65deg,'.$events[$i]->staff->color.' 65%, '.(!is_null($events[$i]->is_application)? $events[$i]->application->treatment->brand->color : $events[$i]->staff->color).' 35%)';
                    $singleEvent['borderColor'] = $events[$i]->staff->color;
                } else {
                    $singleEvent['backgroundColor'] = '#09610c';
                    $singleEvent['borderColor'] = '#09610c';
                }
                
            }



            $isappx = (!is_null($events[$i]->is_application) ? $events[$i]->application->treatment->clave : $events[$i]->title);

            $singleEvent['title'] = $events[$i]->title;
            $singleEvent['start'] = $events[$i]->start_date.'T'.$events[$i]->start_time;
            $singleEvent['end'] = $events[$i]->start_date.'T'.$events[$i]->end_time;
            $singleEvent['allDay'] = false;

            $extendedProps['staff'] = !is_null($events[$i]->staff_id) ? $events[$i]->staff->name : null;
            $extendedProps['staff_id'] = !is_null($events[$i]->staff_id) ? $events[$i]->staff->id : null;
            
            $extendedProps['patient'] = $events[$i]->patient->name;
            $extendedProps['patient_id'] = $events[$i]->patient->id;
            $extendedProps['notas'] = $events[$i]->note;
            $extendedProps['email'] = $events[$i]->patient->email;
            $extendedProps['lang'] = $events[$i]->patient->lang;
            $extendedProps['phone'] = $events[$i]->patient->phone;
            $extendedProps['startDate'] = $events[$i]->start_date;
            $extendedProps['startTime'] = $events[$i]->start_time;
            $extendedProps['endDate'] = $events[$i]->start_date;
            $extendedProps['endTime'] = $events[$i]->end_time;

            $extendedProps['status'] = (is_null($events[$i]->statusOne)? '0':$events[$i]->statusOne->status_id);

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
        //return response()->json($allEvents);
        return view('staff.events-manager.list', ['status' => $status]);
    }

    public function eventSources()
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $events = Event::with(
            [
                'staff',
                'patient',
                'statusOne' => function($q)use($lang){
                    $q->with([
                        'status' => function($q)use($lang){
                            $q->select("name_$lang as name", 'id', 'color');
                        }
                    ]);
                },
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

            if (!is_null($events[$i]->statusOne)) {
                $singleEvent['backgroundColor'] = $events[$i]->statusOne->status->color;
                $singleEvent['borderColor'] = $events[$i]->statusOne->status->color;
            } else {
                if (!is_null( $events[$i]->staff_id)) {
                    $singleEvent['backgroundColor'] = 'linear-gradient(65deg,'.$events[$i]->staff->color.' 65%, '.(!is_null($events[$i]->is_application)? $events[$i]->application->treatment->brand->color : $events[$i]->staff->color).' 35%)';
                    $singleEvent['borderColor'] = $events[$i]->staff->color;
                } else {
                    $singleEvent['backgroundColor'] = '#09610c';
                    $singleEvent['borderColor'] = '#09610c';
                }
                
            }



            $isappx = (!is_null($events[$i]->is_application) ? $events[$i]->application->treatment->clave : $events[$i]->title);

            $singleEvent['title'] = $events[$i]->title;
            $singleEvent['start'] = $events[$i]->start_date.'T'.$events[$i]->start_time;
            $singleEvent['end'] = $events[$i]->start_date.'T'.$events[$i]->end_time;
            $singleEvent['allDay'] = false;

            $extendedProps['patient'] = $events[$i]->patient->name;
            $extendedProps['patient_id'] = $events[$i]->patient->id;
            $extendedProps['notas'] = $events[$i]->note;
            $extendedProps['email'] = $events[$i]->patient->email;
            $extendedProps['lang'] = $events[$i]->patient->lang;
            $extendedProps['phone'] = $events[$i]->patient->phone;
            $extendedProps['startDate'] = $events[$i]->start_date;
            $extendedProps['startTime'] = $events[$i]->start_time;
            $extendedProps['endDate'] = $events[$i]->start_date;
            $extendedProps['endTime'] = $events[$i]->end_time;
            $extendedProps['staff'] = is_null($events[$i]->staff_id)? null:Staff::find($events[$i]->staff_id)->name;

            

            $extendedProps['status'] = (is_null($events[$i]->statusOne)? '0':$events[$i]->statusOne->status_id);

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
        $lang = app()->getLocale();
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
        //return $request;
        $lang = Auth::guard('staff')->user()->lang;
        $staff_id = Auth::guard('staff')->user()->id;
        $lang = app()->getLocale();

        if ($request->isApp == "0") {
            return $this->noAppEvent($request);
        } 
        if ($request->patient_id == 'undefined') {unset($request['patient_id']);}
        if ($request->app == 'undefined') {unset($request['app']);}
        if ($request->isApp == '0') {unset($request['isApp']);}
        if ($request->staff_id == 'undefined') {unset($request['staff_id']);}

        
        $todayDate = Date('Y-m-d');

        $validator = Validator::make($request->all(), [
            'patient' => 'required|string',
            'patient_id' => 'sometimes|nullable|integer|exists:patients,id',
            'email' => 'required|email',
            'start' => 'required|date_format:Y/m/d|after_or_equal:'.$todayDate,
            'timeStart' => 'required|date_format:H:i',
            //'timeEnd' => 'required|after_or_equal:timeStart|date_format:H:i',
            'notes' => 'required|string',
            'lang' => 'required|string|max:2',
            'title' => 'required|string',
            "needPreOps" => [
                $request->has('needPreOps') ? 'required' : '',
                $request->has('needPreOps') ? 'in:0,1' : '',
            ],
            "needPreOpsDate" => [
                $request->needPreOps == '1' ? 'required' : '',
                $request->needPreOps == '1' ? 'date_format:Y/m/d' : '',
            ],
            "titlePreOps" => [
                $request->needPreOps == '1' ? 'required' : '',
                $request->needPreOps == '1' ? 'string' : '',
            ],        
            "notesPreOps" => [
                $request->needPreOps == '1' ? 'required' : '',
                $request->needPreOps == '1' ? 'string' : '',
            ],
            'staff_id' => [
                $request->has('isApp') ? 'required' : '',
                $request->has('isApp') ? 'int' : '',
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

        $timeStart = Carbon::createFromFormat('H:i', $request->timeStart);
        $timeStart->addHour(); // Agrega una hora al tiempo inicial
        $timeEnd = $timeStart->format('H:i'); 
        $request->merge(['timeEnd' => $timeEnd]);

       

        $patient_id = $request->patient_id;
        if ($request->has('patient_lang')) {
            $patient_lang = $request->lang;
        } else {
            $patient_lang = $lang;
        }


        $staff_asignado = $this->setStaffAss($request);
        $patient = Patient::firstOrNew(['email' => $request->email]);
        if (!$patient) {
            $patient = new Patient;
            $patient->name = $request->patient;
            $patient->phone = $request->phone;
            $patient->lang = $lang;
            $patient->code = getCode();
            $patient->password = Hash::make(Str::random(10));

            $patient->save();
        }
        
        $patient_id = $patient->id;

        //return $patient_id;

        $event = new Event;
        $event->staff_id = ($request->isApp == "0") ? null:$staff_asignado->id;
        $event->patient_id = $patient_id;
        $event->title = $request->title;
        $event->start_date = $request->start;
        $event->start_time = $request->timeStart;
        $event->end_date = $request->start;
        $event->end_time = $request->timeEnd;
        $event->note = $request->notes;
        $event->code = getCode();
        $event->application_id = $request->has('isApp') ? $request->app: null;
        $event->is_application = $request->has('isApp') ? $request->isApp: null;
        
        if ($event->save()) {
            $staffData = Staff::findOrFail($staff_id);
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
                $app = Application::with('statusOne')->find($event->application_id);

                $app->statusOne()->delete($app->statusOne->id);
                $app->statusOne()->create(
                    [
                        'status_id' => 6,
                        'indications' => $request->medicalIndications,
                        'recomendations' => $request->medicalRecommendations,
                        'code' => getCode(),
                    ]
                );

            }

            if ($request->needPreOps == "1") {
                $eventPreOps = new Event;
                $eventPreOps->staff_id = $staff_id;
                $eventPreOps->patient_id = $patient_id;
                $eventPreOps->title = $request->titlePreOps;
                $eventPreOps->start_date = $request->needPreOpsDate;
                $eventPreOps->start_time = $request->timeStart;
                $eventPreOps->end_date = $request->needPreOpsDate;
                $eventPreOps->end_time = $request->timeEnd;
                $eventPreOps->note = $request->notesPreOps;
                $eventPreOps->code = getCode();
                $eventPreOps->application_id = $request->has('isApp') ? $request->app: null;
                $eventPreOps->is_application = $request->has('isApp') ? $request->isApp: null;

                $eventPreOps->save();

                $status = Status::find('12');
                    if ($status) {
                        if ($status->type === 'Event') {
                            if (!is_null($eventPreOps->statusOne)) {
                                $eventPreOps->statusOne->delete($eventPreOps->statusOne->id);
                            }
                            $eventPreOps->statusOne()->create(
                                [
                                    'status_id' => 12,
                                    'code' => getCode(),
                                ]
                            );
                        }
                    }
            }


            // Mail::send(new NewEventPatient($dataMsg));
            // Mail::send(new NewEventStaff($dataMsg));

            $lang = app()->getLocale();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Event created successfully!'),
                    'reload' => true,
                    'preops' => isset($eventPreOps) ? $eventPreOps : null,
                    'event' => $event
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

    private function noAppEvent(Request $request) 
    {
        $todayDate = Date('Y-m-d');
        $lang = Auth::guard('staff')->user()->lang;
        $validator = Validator::make($request->all(), [
            'patient' => 'required|string',
            'patient_id' => 'sometimes|nullable|integer|exists:patients,id',
            'email' => 'required|email',
            'start' => 'required|date_format:Y/m/d|after_or_equal:'.$todayDate,
            'timeStart' => 'required|date_format:H:i',
            'notes' => 'required|string',
            'lang' => 'required|string|max:2',
            'title' => 'required|string',
            'phone' => ['required','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $timeStart = Carbon::createFromFormat('H:i', $request->timeStart);
        $timeStart->addHour(); // Agrega una hora al tiempo inicial
        $timeEnd = $timeStart->format('H:i'); 
        $request->merge(['timeEnd' => $timeEnd]);

        if ($request->has('patient_lang')) {
            $patient_lang = $request->lang;
        } else {
            $patient_lang = $lang;
        }

        $patient = Patient::firstOrNew(['email' => $request->email]);
        $patient->name = $request->patient;
        $patient->phone = $request->phone;
        $patient->lang = $lang;
        $patient->code = getCode();
        $patient->password = Hash::make(Str::random(10));

        $patient->save();
        $patient_id = $patient->id;

        $event = new Event;
        $event->staff_id = null;
        $event->patient_id = $patient_id;
        $event->title = $request->title;
        $event->start_date = $request->start;
        $event->start_time = $request->timeStart;
        $event->end_date = $request->start;
        $event->end_time = $request->timeEnd;
        $event->note = $request->notes;
        $event->code = getCode();
        $event->application_id = null;
        $event->is_application = null;

        if ($event->save()) {

            if (!is_null($event->application_id) ) {
                $app = Application::with('statusOne')->find($event->application_id);

                $app->statusOne()->delete($app->statusOne->id);
                $app->statusOne()->create(
                    [
                        'status_id' => 6,
                        'indications' => $request->medicalIndications,
                        'recomendations' => $request->medicalRecommendations,
                        'code' => getCode(),
                    ]
                );

            }

            $lang = app()->getLocale();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Event created successfully!'),
                    'reload' => true,
                    'preops' => isset($eventPreOps) ? $eventPreOps : null,
                    'event' => $event
                ]
            );
        }
    }

    public function update(Request $request)
    {

        $lang = Auth::guard('staff')->user()->lang;

        $lang = app()->getLocale();
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
                
                'notes' => 'required|string',
                'title' => 'required|string',
                // 'staff_id' => 'required|exists:staff,id',
                // 'staff' => 'required|string',
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

            $timeStart = Carbon::createFromFormat('H:i', $request->timeStart);
            $timeStart->addHour(); // Agrega una hora al tiempo inicial
            $timeEnd = $timeStart->format('H:i'); 
            $request->merge(['timeEnd' => $timeEnd]);

            

            $staff_asignado = $this->setStaffAss($request);
            $event->staff_id = ($request->isApp == "0") ? null:$staff_asignado->id;
            $event->patient_id = $request->patient_id;
            $event->title = $request->title;
            $event->start_date = $request->start;
            $event->start_time = $request->timeStart;
            $event->end_date = $request->start;
            $event->end_time = $request->timeEnd;
            $event->note = $request->notes;
            $event->title = $request->title;
            $event->code = getCode();
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
        $lang = app()->getLocale();
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
            $lang = app()->getLocale();

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
                    $package = ($applications->treatment->package != null)? $applications->treatment->package->package:'';
                    $title = $applications->treatment->clave;
                    return '<button type="button" data-clave="'.$title.'" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect margin-right-10 btn-primary btn-add" style="height: 36px; min-width: 36px;width: 36px;" name="'.$brand.', '.$service.', '.$procedure.', '.$package.'" data-id=" '.$applications->id.' "><i class="material-icons">add</i></button>';
                })
                ->addColumn('treatment', function($applications){
                    $brand = $applications->treatment->brand->brand;
                    $service = $applications->treatment->service->service;
                    $procedure = $applications->treatment->procedure->procedure;
                    $package = $package = ($applications->treatment->package != null)? $applications->treatment->package->package:'';
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

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $event = Event::with('statusOne')->find($request->event);
            //return($event);
            if ($event) {
                if ($request->key == 0) {
                    if (!is_null($event->statusOne)) {
                        $event->statusOne->delete($event->statusOne->id);
                    }
                    return response()->json($event);
                } else {
                    $validator = Validator::make($request->all(), [
                        'key' => 'required|exists:statuses,id',
                    ]);
                    if ($validator->fails()) {
                        return response()->json([
                            'success' => false,
                            'go' => '0',
                            'errors' => $validator->getMessageBag()->toArray()
                        ]);
                    }
                    $status = Status::find($request->key);
                    if ($status) {
                        if ($status->type === 'Event') {
                            if (!is_null($event->statusOne)) {
                                $event->statusOne->delete($event->statusOne->id);
                            }
                            $event->statusOne()->create(
                                [
                                    'status_id' => $request->key,
                                    'code' => getCode(),
                                ]
                            );
                            return response()->json($event);
                        }
                    }
                }
            }
        }
    }

    public function getAppsStaff(Request $request)
    {
        return $this->returnarStaffAss($request);
    }

    private function returnarStaffAss($request){
        $lang = Auth::guard('staff')->user()->lang;
        $locale = app()->getLocale();
        
        $app = Application::with(
            [
                'patient' => function ($q) {
                    $q->with(['country', 'state']);
                },
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "brand" => function ($q) {
                                $q->select("brand", "id", "color", "code");
                            },
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang AS service", "id", "code");
                                $q->with(
                                    [
                                        'specialties' => function ($q) use ($lang) {
                                            $q->select("specialties.id", "name_$lang AS specialty", "specialties.id", "code")
                                            ->where('specialties.id', "!=", 10)
                                            ->where('specialties.id', "!=", 5);
                                        }
                                    ]
                                );
                            },
                            "procedure" => function ($q) use ($lang) {
                                $q->select("procedure_$lang AS procedure", "id", "has_package", "code");
                            },
                            "package" => function ($q) use ($lang) {
                                $q->select("package_$lang AS package", "id", "code");
                            },
                        ]
                    );
                },
                'assignments' => function ($q) use ($lang) {
                    $q->with(
                        [
                            'specialties' => function($q) {
                                $q->where('specialties.id', "!=", 10)
                                ->where('specialties.id', "!=", 5);
                            }
                        ]
                    );
                }

            ]
        )
        ->findOrFail($request->app);


        $is_selected_staff = '';
        foreach ($app->assignments as $key => $value) {
            if (!empty($value->specialties)) {
                $is_selected_staff = $value->id;
            }
        }


        $getStaff = $app->treatment->service->specialties[0];

       $staff = Staff::whereHas('specialties', function ($query) use($getStaff){
            $query->where('specialties.id', $getStaff->id);
        })->get();

        return response()->json([
            'staff' => $staff,
            "asignado" => $is_selected_staff,
            'ass_ass' => $getStaff->id,
        ]);
    }

    private function setStaffAss($request){


        $lang = Auth::guard('staff')->user()->lang;
        $locale = app()->getLocale();
        
        $app = Application::with(
            [
                'patient' => function ($q) {
                    $q->with(['country', 'state']);
                },
                'treatment' => function ($q) use ($lang) {
                    $q->with(
                        [
                            "brand" => function ($q) {
                                $q->select("brand", "id", "color", "code");
                            },
                            "service" => function ($q) use ($lang) {
                                $q->select("service_$lang AS service", "id", "code");
                                $q->with(
                                    [
                                        'specialties' => function ($q) use ($lang) {
                                            $q->select("specialties.id", "name_$lang AS specialty", "specialties.id", "code")
                                            ->where('specialties.id', "!=", 10)
                                            ->where('specialties.id', "!=", 5);
                                        }
                                    ]
                                );
                            },
                            "procedure" => function ($q) use ($lang) {
                                $q->select("procedure_$lang AS procedure", "id", "has_package", "code");
                            },
                            "package" => function ($q) use ($lang) {
                                $q->select("package_$lang AS package", "id", "code");
                            },
                        ]
                    );
                },
                'assignments' => function ($q) use ($lang) {
                    $q->with(
                        [
                            'specialties' => function($q) {
                                $q->where('specialties.id', "!=", 10)
                                ->where('specialties.id', "!=", 5);
                            }
                        ]
                    );
                }

            ]
        )
        ->findOrFail($request->app);


        $is_selected_staff = '';
        foreach ($app->assignments as $key => $value) {
            if (!empty($value->specialties)) {
                $is_selected_staff = $value->id;
            }
        }
        $getStaff = $app->treatment->service->specialties[0];
        $has_assinaments = false;
        $old_assignament = null;
        $assignment = $app->assignments()->get();

        foreach ($assignment as $item) {
            if ($item->pivot->ass_as == $getStaff->id) {
               $has_assinaments = true;
               $old_assignament = $item->id;
            }
        }
        //return response()->json($old_assignament);
        if ($has_assinaments && !is_null($old_assignament)) { // significa que si tiene uno anterior 
           $assignment = $app->assignments()->where('staff_id', $old_assignament)->first();
           if ($assignment) {
                $app->assignments()->detach($assignment->id);

            }
        }
        $staff = Staff::find($request->staff_id);

        $app->assignments()->attach($staff->id, ['code' => getCode(), 'ass_as' => $getStaff->id]);

       return $staff;
    }
}

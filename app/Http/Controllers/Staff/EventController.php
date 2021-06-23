<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Mail\NewEventPatient;
use App\Mail\NewEventStaff;
use App\Models\Event;
use App\Models\Patient;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Lang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EventController extends Controller
{

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
        //return $events;
        return view('staff.events-manager.list');
    }

    public function eventSources()
    {
        $events = Event::with(
            [
                'staff',
                'patient'
            ]
        )
        ->get();
        $allEvents = [];
        $singleEvent = [];
        $extendedProps = [];
        for ($i = 0; $i < count($events); $i++)
        {
            $singleEvent['id'] = $events[$i]->id;
            $singleEvent['backgroundColor'] = $events[$i]->staff->Color;
            $singleEvent['borderColor'] = $events[$i]->staff->Color;
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
            $extendedProps['phone'] = $events[$i]->patient->phone;
            $extendedProps['startDate'] = $events[$i]->start_date;
            $extendedProps['startTime'] = $events[$i]->start_time;;
            $extendedProps['endDate'] = $events[$i]->start_date;
            $extendedProps['endTime'] = $events[$i]->end_time;
            $singleEvent['extendedProps'] = $extendedProps;
            $allEvents[] = $singleEvent;
        }
        return response()->json($allEvents);
    }

    public function busquedaStaff(Request $request)
    {
        $search = Staff::where("name",'like', "%".$request->key."%")
        ->where('show', '=', 1)
        ->get();
        return $search;
    }

    public function busquedaPatient(Request $request)
    {
        $search = Patient::where("name",'like', "%".$request->key."%")
        ->get();
        return $search;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        if ($request->patient_id == 'undefined') {unset($request['patient_id']);}
        $todayDate = Date('Y-m-d');
        $validator = Validator::make($request->all(), [
            'patient' => 'required|string',
            'patient_id' => 'sometimes|integer|exists:patients,id',
            'email' => 'required|email',
            'start' => 'required|date_format:Y/m/d|after_or_equal:'.$todayDate,
            'timeStart' => 'required|date_format:H:i',
            'timeEnd' => 'required|after_or_equal:timeStart|date_format:H:i',
            'notes' => 'required|string',
            'lang' => 'required|string|max:2',
            'title' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'staff' => 'required|string',
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

        if ($event->save()) {
            $staffData = Staff::findOrFail($request->staff_id);
            if ($request->lang == 'es') {
                $dateP = $this->fechaEspanol($event->start_date);
            } else {
                $dateP = $this->fechaIngles($event->start_date);
            }
            if ($staffData->lang == 'es') {
                $dateD = $this->fechaEspanol($event->start_date);
            } else {
                $dateD = $this->fechaIngles($event->start_date);
            }
            
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
                'hour_to' => $request->start,
                'hour_from' => $request->timeEnd,

                'note' => $request->notes
            );


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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //return $request;
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $todayDate = Date('Y-m-d');
        $event = Event::find($request->event);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function fechaEspanol($fecha)
    {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
    }
     public function fechaIngles($fecha)
    {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_ES, $dias_EN, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_ES, $meses_EN, $mes);
        //return $nombredia.", ".$numeroDia." de ".$nombreMes." de ".$anio;
        return $nombredia.", ".$nombreMes." ".$numeroDia.", ".$anio;
    }
}

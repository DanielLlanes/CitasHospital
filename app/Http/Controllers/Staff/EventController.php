<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Patient;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
        // $this->middleware('can:ListAdmins')->only(['getAdmins', 'index']);
        // $this->middleware('can:CreateAdmins')->only(['create','store']);
        // $this->middleware('can:EditAdmins')->only(['edit','update']);
        // $this->middleware('can:DeleteAdmins')->only(['destroy']);
        // $this->middleware('can:ActivateAdmins')->only(['activarAdministradores']);
        // $this->middleware('can:ShowAdmins')->only(['show']);
        date_default_timezone_set('America/Tijuana');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            $extendedProps['staff_id'] = $events[$i]->staff->name;
            $extendedProps['patient'] = $events[$i]->patient->name;
            $extendedProps['patient_id'] = $events[$i]->patient->id;
            $extendedProps['notas'] = $events[$i]->notas;
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
        $event = Event::find($request->id);
        if ($event) {
            $date = explode( 'T', $request->start );
            $event->start_date = $date[0];
            if ($event->save()) {
               return response()->json(
                   [
                       'icon' => 'success',
                       'msg' => 'Evento editado satisfactoriamente!',
                       'reload' => true
                   ]
               );
            }
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'La fecha que intenta editar no existe o fue eliminada anteriormente!',
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
        // if ($request->has('patient_id')) {
        //     $patient_id .= $request->patient_id;
        // }
        $patienExist = Patient::where('email', $request->email)->first();
        if (!$patienExist) {
            $patient = New Patient;
            $patient->name = $request->patient;
            $patient->email = $request->email;
            $patient->phone = $request->phone;
            $patient->save();
            $patient_id = $pantient->id;
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
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => 'Evento creado satisfactoriamente!',
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'La fecha que intenta editar no existe o fue eliminada anteriormente!',
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
    public function update(Request $request, $id)
    {
        // $event = Event::first()
        // return response()->json(
        //     [
        //         'msg' => $request,
        //     ]
        // );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

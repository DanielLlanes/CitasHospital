<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Staff\Country;
use App\Models\Staff\Patient;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
        date_default_timezone_set('America/Tijuana');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::with(
            [
                'country',
                'state'
            ]
        )->get();
        return view('staff.patient-manager.list');
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $patient = Patient::with(
                [
                    'country',
                    'state'
                ]
            )->get();

            return DataTables::of($patient)
                ->addIndexColumn()
                ->addColumn('avatar', function($patient){
                    if (is_null($patient->avatar)) {
                       $avatar ='
                                <a href="'.asset("staffFiles/assets/img/user/user.jpg").'" data-effect="mfp-zoom-in" class="a">
                                    <img src="'.asset("staffFiles/assets/img/user/user.jpg").'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$patient->name.'"/>
                                </a>
                            ';
                    } else {
                        $avatar = '
                                    <a href="'.asset($patient->avatar).'" data-effect="mfp-zoom-in" class="a">
                                        <img src="'.asset($patient->avatar).'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$patient->name.'"/>
                                    </a>
                                ';
                    }
                    return $avatar;
                })
                ->addColumn('name', function($patient){
                    return $patient->name;
                })
                ->addColumn('email', function($patient){
                        return $patient->email;
                })
                ->addColumn('dob', function($patient){
                    return $patient->created_at->toDayDateTimeString();
                })
                ->addColumn('phone', function($patient){
                    return $patient->phone;
                })
                ->addColumn('mobile', function($patient){
                    return $patient->mobile;
                })
                ->addColumn('ecn', function($patient){
                    return $patient->ecn;
                })
                ->addColumn('ecp', function($patient){
                    return $patient->ecp;
                })
                ->addColumn('lang', function($patient){
                    return ($patient->lang == 'es' ? "Spanich":"English");
                })
                ->addColumn('action', 'staff.patient-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'avatar', 'name', 'email', 'dob', 'phone', 'mobile', 'ecn', 'ecp', 'lang', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('staff.patient-manager.add', ["countries" => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $this->validate($request, [
            'email' => 'required|max:255|email',
        ]);

        $lang = app()->getLocale();

        $patient = Patient::where('email', $request->email)->first();
        $treatmentBefore = true;
        if (!$patient) { //Sí el paciente no existe
            $treatmentBefore = false;
            $this->validate($request, [
                'name' => 'required|string',
                'sex' => 'required|string|',
                'age' => 'required|numeric|between:18,99',
                'dob' => 'required|date',
                'phone' => ['unique:patients,phone', 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'mobile' => ['required', 'different:phone', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'email' => 'required|max:255|email|unique:patients,email',
                'address' => 'required',
                'country_id' => 'required|integer',
                'state_id' => 'required|integer',
                'city' => 'required|string',
                'zip' => 'required|string',
                'ecn' => 'required|string',
                'ecp' => ['required', 'different:phone', 'different:mobile','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            ]);

            $unHashPassword = Str::random(8);
            $patient = new Patient;
            $patient->treatmentBefore = $treatmentBefore;
            $patient->name = $request->name;
            $patient->sex = $request->sex;
            $patient->age = $request->age;
            $patient->dob = $request->dob;
            $patient->phone = $request->phone;
            $patient->mobile = $request->mobile;
            $patient->email = $request->email;
            $patient->address = $request->address;
            $patient->country_id = $request->country_id;
            $patient->state_id = $request->state_id;
            $patient->city = $request->city;
            $patient->zip = $request->zip;
            $patient->ecn = $request->ecn;
            $patient->ecp = $request->ecp;
            $patient->lang = $request->language;
            $patient->password = Hash::make($unHashPassword);

            if($request->hasFile('avatar'))
            {
                $avatar = $request->file('avatar');
                $destinationPath = public_path('/uploads/patient/');
                $img_name = time().'.'.$avatar->getClientOriginalExtension();
                $img = Image::make($avatar->getRealPath());
                $img->resize(300, 365, function ($constraint) {
                    $constraint->aspectRatio();
                });
                File::exists($destinationPath) or File::makeDirectory($destinationPath,0777,true);
                $img->save($destinationPath.'/'.$img_name);
                $patient->photo = '/uploads/patient/'.$img_name;

            }

            if ($patient->save()) {
                return redirect()->route('staff.patients.patient')->with(
                    [
                        'sys-message' => '',
                        'icon' => 'success',
                        'msg' => Lang::get('Patient created successfully!')
                    ]
                );
            }
            return redirect()->back()->with(
                [
                    'sys-message' => '',
                    'icon' => 'error',
                    'msg' => Lang::get('We couldn’t create the patient please try again!')
                ]
            );
        }
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
        $patient = Patient::where('id', $id)
        ->first();
        $countries = Country::all();

        return view('staff.patient-manager.edit', ["patient" => $patient, "countries" => $countries]);
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
        $this->validate($request, [
            'name' => 'required|string',
            'sex' => 'required|string|',
            'age' => 'required|numeric|between:18,99',
            'dob' => 'required|date',
            'phone' => ['unique:patients,phone,'.$id, 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'mobile' => ['required', 'different:phone', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'email' => 'required|max:255|email|unique:patients,email,'.$id,
            'address' => 'required',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'city' => 'required|string',
            'zip' => 'required|string',
            'ecn' => 'required|string',
            'ecp' => ['required', 'different:phone', 'different:mobile','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
        ]);
        $patient = Patient::find($id);
        $patient->name = $request->name;
        $patient->sex = $request->sex;
        $patient->age = $request->age;
        $patient->dob = $request->dob;
        $patient->phone = $request->phone;
        $patient->mobile = $request->mobile;
        $patient->email = $request->email;
        $patient->address = $request->address;
        $patient->country_id = $request->country_id;
        $patient->state_id = $request->state_id;
        $patient->city = $request->city;
        $patient->zip = $request->zip;
        $patient->ecn = $request->ecn;
        $patient->ecp = $request->ecp;
        $patient->lang = $request->language;

        if ($patient->save()) {
            return redirect()->route('staff.patients.patient')->with(
                [
                    'sys-message' => '',
                    'icon' => 'success',
                    'msg' => Lang::get('Patient edited successfully!')
                ]
            );
        }
        return redirect()->back()->with(
            [
                'sys-message' => '',
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t edit the patient please try again!')
            ]
        );

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

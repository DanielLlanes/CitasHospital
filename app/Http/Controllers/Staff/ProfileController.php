<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\EducationBackgroundStaff;
use App\Models\Staff\PostgraduateStudiesStaff;
use App\Models\Staff\Staff;
use App\Models\Staff\UpdateCourseStaff;
use App\Models\Staff\WorkHistoryStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
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
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $staff = Staff::with([
            'roles' => function($query) use ($lang) {
                $query->select(["id", "name_$lang AS Rname"]);
            },
            'workhistory',
            'educationbackground',
            'postgraduatestudies',
            'updatecourses',
            'permissions',
            'specialties' => function($query) use ($lang){
                $query->select(["specialties.id", "name_$lang AS Sname"]);
            },
            'assignToService' => function($query) use ($lang){
                $query->select(["services.id", "service_$lang AS service"]);
            },
        ])
        ->findOrFail(Auth::guard('staff')->user()->id);
        //return $staff;
        return view('staff.profile-manager.profile', ['staff' => $staff]);
    }

    /**
     *
    */
    public function changeOwnPassStaff(Request $request){
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|different:current_password',
            'password_confirmation' => 'required|required_with:new_password|same:new_password|string|min:8',

         ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $user = Auth::guard('staff')->user();
        //return($user);

        if (Hash::check($request->current_password, $user->password)) {
            $staff = Auth::guard('staff')->user();
            $staff->password = Hash::make($request->new_password);
            $staff->set_pass = true;
            if ($staff->save()) {
                return response()->json(
                    [

                        'icon' => 'success',
                        'msg' => Lang::get('Password edited successfully!'),
                        'reload' => true
                    ]
                );
            }
        }
        return response()->json(
            [

                'icon' => 'error',
                'msg' => Lang::get('Your current password does not match our records!'),
                'reload' => true
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
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);
        $staff = Staff::with([
            'roles' => function($query) use ($lang) {
                $query->select(["id", "name_$lang AS Rname"]);
            },
            'permissions',
            'specialties' => function($query) use ($lang){
                $query->select(["specialties.id", "name_$lang AS Sname"]);
            },
            'assignToService' => function($query) use ($lang){
                $query->select(["services.id", "service_$lang AS service"]);
            },
        ])
        ->findOrFail(Auth::guard('staff')->user()->id);
        return view('staff.profile-manager.add-profile', ['staff' => $staff]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function workHistory(Request $request)
    {
        
        $staffID = Auth::guard('staff')->user()->id;
        $staff = Staff::findOrFail($staffID);
        $validator = Validator::make($request->all(), [
            "job_company"       => "required|array|min:1",
            "job_company.*"     => "required|max:50|string",
            "job_title"         => "required|array|min:1",
            "job_title.*"       => "required|max:50|string",
            "job_from_year"     => "required|array|min:1",
            "job_from_year.*"   => "required|max:50|string",
            "job_to_year"       => "required|array|min:1",
            "job_to_year.*"     => "required|max:50|string",
            "job_notes"         => "required|array|min:1",
            "job_notes.*"       => "required|max:250|string",
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'success'   => false,
                'go'        => '0',
                'errors'    => $validator->getMessageBag()->toArray()

            ]); // 400 being the HTTP code for an invalid request.
        }
        
        $insert_jobs = [];
        for ($i = 0; $i < count($request->job_company); $i++) {
            $insert_jobs[] = [
                'staff_id' => $staffID,
                'job_company' => $request->job_company[$i],
                'job_title' => $request->job_title[$i],
                'job_from_year' => $request->job_from_year[$i],
                'job_to_year' => $request->job_to_year[$i],
                'job_notes' => $request->job_notes[$i],
            ];
        }
        $staff->workhistory()->delete();
        WorkHistoryStaff::insert($insert_jobs);
        return response()->json([
            'success' => true,
            'go' => '1',
            'icon' => 'success',
            'title' => 'the work history data was uploaded successfully'
        ]);
    }

    public function educationBackground(Request $request)
    {
        //return $request;
        $staffID = Auth::guard('staff')->user()->id;
        $staff = Staff::findOrFail($staffID);
        $validator = Validator::make($request->all(), [
            "education_school"       => "required|array|min:1",
            "education_school.*"     => "required|max:50|string",
            "education_title"         => "required|array|min:1",
            "education_title.*"       => "required|max:50|string",
            "education_from_year"     => "required|array|min:1",
            "education_from_year.*"   => "required|max:50|string",
            "education_to_year"       => "required|array|min:1",
            "education_to_year.*"     => "required|max:50|string",
            "education_notes"         => "required|array|min:1",
            "education_notes.*"       => "required|max:250|string",
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'success'   => false,
                'go'        => '0',
                'errors'    => $validator->getMessageBag()->toArray()

            ]); // 400 being the HTTP code for an invalid request.
        }
        
        $insert_education = [];
        for ($i = 0; $i < count($request->education_school); $i++) {
            $insert_education[] = [
                'staff_id' => $staffID,
                'education_school' => $request->education_school[$i],
                'education_title' => $request->education_title[$i],
                'education_from_year' => $request->education_from_year[$i],
                'education_to_year' => $request->education_to_year[$i],
                'education_notes' => $request->education_notes[$i],
            ];
        }
        $staff->educationbackground()->delete();
        EducationBackgroundStaff::insert($insert_education);
        return response()->json([
            'success' => true,
            'go' => '1',
            'icon' => 'success',
            'title' => 'the education background data was uploaded successfully'
        ]);
    }

    public function postgraduateStudies(Request $request)
    {
        //return $request;
        $staffID = Auth::guard('staff')->user()->id;
        $staff = Staff::findOrFail($staffID);
        $validator = Validator::make($request->all(), [
            "postgraduate_school"       => "required|array|min:1",
            "postgraduate_school.*"     => "required|max:50|string",
            "postgraduate_title"         => "required|array|min:1",
            "postgraduate_title.*"       => "required|max:50|string",
            "postgraduate_from_year"     => "required|array|min:1",
            "postgraduate_from_year.*"   => "required|max:50|string",
            "postgraduate_to_year"       => "required|array|min:1",
            "postgraduate_to_year.*"     => "required|max:50|string",
            "postgraduate_notes"         => "required|array|min:1",
            "postgraduate_notes.*"       => "required|max:250|string",
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'success'   => false,
                'go'        => '0',
                'errors'    => $validator->getMessageBag()->toArray()

            ]); // 400 being the HTTP code for an invalid request.
        }
        
        $insert_postgraduate = [];
        for ($i = 0; $i < count($request->postgraduate_school); $i++) {
            $insert_postgraduate[] = [
                'staff_id' => $staffID,
                'postgraduate_school' => $request->postgraduate_school[$i],
                'postgraduate_title' => $request->postgraduate_title[$i],
                'postgraduate_from_year' => $request->postgraduate_from_year[$i],
                'postgraduate_to_year' => $request->postgraduate_to_year[$i],
                'postgraduate_notes' => $request->postgraduate_notes[$i],
            ];
        }
        $staff->postgraduatestudies()->delete();
        PostgraduateStudiesStaff::insert($insert_postgraduate);
        return response()->json([
            'success' => true,
            'go' => '1',
            'icon' => 'success',
            'title' => 'the postgaduate studies data was uploaded successfully'
        ]);
    }
    public function updateCourses(Request $request)
    {
        //return $request;
        $staffID = Auth::guard('staff')->user()->id;
        $staff = Staff::findOrFail($staffID);
        $validator = Validator::make($request->all(), [
            "course_school"       => "required|array|min:1",
            "course_school.*"     => "required|max:50|string",
            "course_title"         => "required|array|min:1",
            "course_title.*"       => "required|max:50|string",
            "course_year"     => "required|array|min:1",
            "course_year.*"   => "required|max:50|string",
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'success'   => false,
                'go'        => '0',
                'errors'    => $validator->getMessageBag()->toArray()

            ]); // 400 being the HTTP code for an invalid request.
        }
        
        $insert_course = [];
        for ($i = 0; $i < count($request->course_school); $i++) {
            $insert_course[] = [
                'staff_id' => $staffID,
                'course_school' => $request->course_school[$i],
                'course_title' => $request->course_title[$i],
                'course_year' => $request->course_year[$i],
            ];
        }
        $staff->updatecourses()->delete();
        UpdateCourseStaff::insert($insert_course);
        return response()->json([
            'success' => true,
            'go' => '1',
            'icon' => 'success',
            'title' => 'the update courses data was uploaded successfully'
        ]);
    }
    public function careerObjetive(Request $request)
    {
        //return $request;
        $staffID = Auth::guard('staff')->user()->id;
        $staff = Staff::findOrFail($staffID);
        $validator = Validator::make($request->all(), [
            "career_objective"     => "required|string",
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'success'   => false,
                'go'        => '0',
                'errors'    => $validator->getMessageBag()->toArray()

            ]); // 400 being the HTTP code for an invalid request.
        }
        
        $staff->updatecourses()->delete();
        UpdateCourseStaff::insert(['staff_id' => $staffID, 'career_objective' => $request->career_objective]);
        return response()->json([
            'success' => true,
            'go' => '1',
            'icon' => 'success',
            'title' => 'the update courses data was uploaded successfully'
        ]);
    }
    public function UploadImagesPublicProfile(Request $request)
    {
        //return $request;
        $staffID = Auth::guard('staff')->user()->id;
        $staff = Staff::findOrFail($staffID);
        $validator = Validator::make($request->all(), [
            "course_school"       => "required|array|min:1",
            "course_school.*"     => "required|max:50|string",
            "image_file"         => "required|array|min:1",
            "image_file.*"       => "'required|image|mimes:jpeg,png,jpg,gif",
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'success'   => false,
                'go'        => '0',
                'errors'    => $validator->getMessageBag()->toArray()

            ]); // 400 being the HTTP code for an invalid request.
        }
        
        $insert_course = [];
        for ($i = 0; $i < count($request->course_school); $i++) {
            $insert_course[] = [
                'staff_id' => $staffID,
                'course_school' => $request->course_school[$i],
                'course_title' => $request->course_title[$i],
                'course_year' => $request->course_year[$i],
            ];
        }
        $staff->updatecourses()->delete();
        UpdateCourseStaff::insert($insert_course);
        return response()->json([
            'success' => true,
            'go' => '1',
            'icon' => 'success',
            'title' => 'the update courses data was uploaded successfully'
        ]);
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
        //
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

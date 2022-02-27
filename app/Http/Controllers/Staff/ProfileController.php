<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\CareerObjetiveStaff;
use App\Models\Staff\EducationBackgroundStaff;
use App\Models\Staff\ImageProfileStaff;
use App\Models\Staff\PostgraduateStudiesStaff;
use App\Models\Staff\Staff;
use App\Models\Staff\UpdateCourseStaff;
use App\Models\Staff\WorkHistoryStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


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
        $staffID = Auth::guard('staff')->user()->id;

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
            'imageOne',
            'imageMany',
            'careerobjetive',
            'specialties' => function($query) use ($lang){
                $query->select(["specialties.id", "name_$lang AS Sname"]);
            },
            'assignToService' => function($query) use ($lang){
                $query->select(["services.id", "service_$lang AS service"]);
            },
        ])
        ->findOrFail($staffID);
        //return $staff;
        return view('staff.profile-manager.profile', ['staff' => $staff]);
    }
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
    public function create()
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
            'imageOne',
            'imageMany',
            'careerobjetive',
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
        return view('staff.profile-manager.add-profile', ['staff' => $staff]);
    }
    public function workHistory(Request $request)
    {
        
        $staffID = ($request->has('id')) ? $request->id :Auth::guard('staff')->user()->id;
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
            "job_notes.*"       => "required|string",
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
        $staffID = ($request->has('id')) ? $request->id :Auth::guard('staff')->user()->id;
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
            "education_notes.*"       => "required|string",
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
        $staffID = ($request->has('id')) ? $request->id :Auth::guard('staff')->user()->id;
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
            "postgraduate_notes.*"       => "required|string",
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
        $staffID = ($request->has('id')) ? $request->id :Auth::guard('staff')->user()->id;
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

        $staffID = ($request->has('id')) ? $request->id :Auth::guard('staff')->user()->id;
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
        
        $staff->careerobjetive()->delete();
        CareerObjetiveStaff::insert(['staff_id' => $staffID, 'career_objective' => $request->career_objective]);
        return response()->json([
            'success' => true,
            'go' => '1',
            'icon' => 'success',
            'title' => 'the career objective data was uploaded successfully'
        ]);
    }
    public function uploadImagesPublicProfile(Request $request)
    {
        //return $request;
        
        $staffID = ($request->has('id')) ? $request->id : Auth::guard('staff')->user()->id;
        
        $staff = Staff::findOrFail($staffID);
        
        $validator = Validator::make($request->all(), [
            "dropify"       => "required|image|mimes:jpeg,png,jpg,gif",
            "title"       => "required|string|max:50",
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'success'   => false,
                'go'        => '0',
                'errors'    => $validator->getMessageBag()->toArray()

            ]); // 400 being the HTTP code for an invalid request.
        }
        $code = time().uniqid(Str::random(30));

        if ($staff->public_profile == 1) {
            if ($request->code != 'undefined') {
                return $request;

                $old_image = $staff->imageMany()->where('code', $request->code)->first();
                //return($old_image);

                if (!$old_image) {
                    return response()->json([
                        'success'   => false,
                        'go'        => '0',
                        'what'      => "old_image_no"
                    ]);
                }

                $imageForDelete = $old_image->image;
                $idForDelete = $old_image->id;

                $old_image->delete();
                if( file_exists($imageForDelete) ){
                    unlink(public_path($imageForDelete));
                }
                //return;
            } 
            $request->merge(["code" => $code]);

            $image = $request->file('dropify');

            $destinationPath = storage_path('app/public/staff/public_profile');
            $img_name = $code.'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = Image::make($image)->width();
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);
            $img->save($destinationPath."/".$img_name, '99');
            $image = "storage/staff/public_profile/$img_name";
            $img->destroy();
           
            //return $request;
            //$id = ImageProfileStaff::insertGetId(["staff_id" => $staffID, "code" => $code, 'image' => $image, 'title' => $request->title]);
            //
            $image = $staff->imageMany()->create(["code" => $code, 'image' => $image, 'title' => $request->title, 'order' => $request->order]);
            
            return response()->json([
                'success' => true,
                'go' => '1',
                'image' => $image,
                'icon' => 'success',
                'title' => 'the image was uploaded successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'go' => '2',
            'image' => '',
            'icon' => 'error',
            'title' => "This user does't have a public profile" 
        ]);        
    }
    public function deleteImagesPublicProfile(Request $request)
    {
        $staffID = ($request->has('id')) ? $request->id : Auth::guard('staff')->user()->id;

        $staff = Staff::findOrFail($staffID);

        if ($request->has('code') && $request->code != 'undefined') {

            $old_image = $staff->imageMany()->where('code', $request->code)->first();

            if (!$old_image) {
                return response()->json([
                    'success'   => false,
                    'go'        => '0',
                ]);
            }

            $imageForDelete = $old_image->image;
            $idForDelete = $old_image->id;

            $old_image->delete();

            if( file_exists($imageForDelete) ){
                unlink(public_path($imageForDelete));
            }

            return response()->json([
                'success'   => true,
                'go'        => '0',
                'icon' => 'success',
                'title' => 'the image was removed successfully'
            ]);

        }
    }
}

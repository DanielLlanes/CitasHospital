<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\Staff\Facility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class FacilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::with('imageMany')->get();
        return view('staff.page-settings.facilities', ['facilities' => $facilities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFacilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return($request);
        $validator = Validator::make($request->all(), [
            'caption_en' => 'required|array|min:1',
            'caption_en.*' => 'required|string',
            'caption_es' => 'required|array|min:1',
            'caption_es.*' => 'required|string',
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'title_en' => 'required|string',
            'title_es' => 'required|string',
            'files' => 'required|array|min:1',
            'files.*' => 'mimes:jpeg,jpg,png,gif|required|image',
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $facility = new Facility;
        $facility->description_en = $request->description_en;
        $facility->description_es = $request->description_es;
        $facility->name_en = $request->title_en;
        $facility->name_es = $request->title_es;
        $facility->order = $request->order;
        $facility->code = getCode();

        if ($facility->save()) {
            foreach ($request->file('files') as $key => $file) {
                $destinationPath = storage_path('app/public').'/facilities/images';
                $img_name = time().uniqid(Str::random(30)).'.'.$file->getClientOriginalExtension();
                $img = Image::make($file->getRealPath());
                $data = getimagesize($file);
                 $width = $data[0];
                 $height = $data[1];
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);
                $img->save($destinationPath."/".$img_name, '100');
                $imge = "storage/facilities/images/$img_name";
                $loop = 0;
                $image = $facility->imageMany()->create(["code" => getCode(), 'image' => $imge , 'caption_en' => $request->caption_en[$loop], 'caption_es' => $request->caption_es[$loop], 'title' => null, 'order' => ($loop + 1)]);
                $loop++;
           }
        }

        return response()->json([
            'success' => true,
            'icon' => 'success',
            'msg' => "Creado satisfactoriamente",
            'facility' =>  $facility->load('imageMany'),
            'order' => $request->order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFacilityRequest  $request
     * @param  \App\Models\Staff\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $f = Facility::with('imageMany')->where('code', $request->code)->first();
        if ($f) {
            if (count($f->imageMany) > 0) {
                foreach ($f->imageMany as $key => $image) {
                    $img = $f->imageMany()->where('id', $image->id)->first();
                    if ($img) {
                       if( file_exists($img->image) ){
                            unlink(public_path($img->image));
                        }
                        $img->forceDelete();
                    }
                }
            }
            $f->delete();


            $fs = Facility::all();

            foreach ($fs as $key => $f) {
                $or = ($key + 1);
                $f->order = $or;
                $f->save();
            }

            return response()->json('done');
        }
    }
}

<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\TimeLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;

class TimeLineController extends Controller
{
    public function Index()
    {

    }
    public function store(Request $request){

        return response()->json($request);
        // return response()->json([
        //     '$count'=> count($request->file('file')),
        // ]);

        if ($request->message == '<p><br></p>') {
            $request->merge(["message" => null]);
        }
        $validator = Validator::make($request->all(), [
            'message' => 'nullable|sometimes|string',
            'app' => 'required|exists:applications,id',
            'files' => 'nullable|sometines',
            'files.*' => 'nullable|sometines|image|mimes:jpg,jpeg,png,bmp,tiff',
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }


        $flag = false;
        if ($request->file('file')) {
            if (count($request->file('file')) > 0) {
                $flag = true;
            }
        }

        if (!is_null($request->message)) {
            $flag = true;
        }

        if ($flag) {
            $timeLine = new TimeLine;
            $timeLine->application_id = $request->app;
            $timeLine->staff_id = Auth::guard('staff')->user()->id;
            $timeLine->message = $request->message;
            $timeLine->code = getCode();
        }

        $timeLine->save();

        if ($request->file('file')) {
            foreach ($request->file('file') as $key => $img) {
                Log::emergency($img);
                $destinationPath = storage_path('app/public').'/application/timeLine';
                $img_name = time().uniqid(Str::random(30)).'.'.$img->getClientOriginalExtension();
                $image = Image::make($img->getRealPath());
                $height = Image::make($image)->height();
                $width = Image::make($image)->width();
                $image->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

                $image->save($destinationPath."/".$img_name, '85');
                $imgUrl = "storage/application/timeLine/$img_name";
                $timeLine->imageMany()->create(["code" => getCode(), 'image' => $imgUrl, 'title' => null, 'order' => ($key+1)]);
                $image->destroy();
            }
        }
        $post = TimeLine::with([
            'imageMany', 
            'application',
            'staff'  => function($q)
            {
                $q->with('imageOne');
            },
        ])
        ->find($timeLine->id);
        return response()->json([
            'success' => true,
            'message' => 'agragado correctamente',
            'icon' => 'success',
            'post' => $post,
        ]);
    }

    public function show(Request $request)
    {
        $offset = $request->offset;
        $limit = $request->limit;
        $post = TimeLine::orderBy('id', 'DESC')
        ->where('application_id', $request->app)
        ->with([
            'imageMany', 
            'application',
            'staff'  => function($q)
            {
                $q->with('imageOne');
            },
        ])
        ->skip($offset)->take($limit)->get();
        return response()->json([
            'success' => true,
            'message' => 'agragado correctamente',
            'icon' => 'success',
            'post' => $post,
        ]);
    }
}

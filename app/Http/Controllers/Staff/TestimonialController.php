<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\Staff\Brand;
use App\Models\Staff\Procedure;
use App\Models\Staff\Testimonial;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
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
        $slider = [];
        return view('staff.page-settings.testimonials', ["slider" => $slider]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTestimonialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $procedure = json_decode($request->procedure, true);
        $procedure_id = $procedure[0]['id'] ;
        $procedure_code = $procedure[0]['code'];
        $procedure_name = $procedure[0]['text'];
        $brand = json_decode($request->brand, true);
        $brand_id = $brand[0]['id'] ;
        $brand_code = $brand[0]['code'];
        $brand_name = $brand[0]['text'];

        $request->merge(["brand_id" => $brand_id]);
        $request->merge(["procedure_id" => $procedure_id]);
        
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|integer|exists:brands,id',
            'procedure_id' => 'required|integer|exists:procedures,id',
            'image' => 'mimes:jpeg,jpg,png,gif|required|image'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray(),
                'refresh' => true,
            ]);
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = storage_path('app/public').'/testimonial/image';
            $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = 684;
            $height = 1024;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            //$img->save($destinationPath."/".$img_name, '100');
            $image = "storage/testimonial/image/$img_name";

            //$img->destroy();
        }

        $testimonial = new Testimonial;
        $testimonial->brand_id = $request->brand_id;
        $testimonial->procedure_id = $request->procedure_id;
        $testimonial->order = null; 
        $testimonial->code = getCode();

        if ($testimonial->save()) {
            if ($image !== '') {
                $img->save($destinationPath."/".$img_name, '100');
                $img->destroy();

                $testimonial->imageOne()->create(
                    ['image' => $image, 'code' => time().uniqid(Str::random(30))]
                );
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => 'The image was successfully stored',
                        'reload' => false,
                        "testimonial" => $testimonial,
                        'imageData' => $testimonial->load('imageOne')->imageOne,
                    ]
                );
            }
           
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $procedure = json_decode($request->procedure, true);
        $procedure_id = $procedure[0]['id'] ;
        $procedure_code = $procedure[0]['code'];
        $procedure_name = $procedure[0]['text'];
        $brand = json_decode($request->brand, true);
        $brand_id = $brand[0]['id'] ;
        $brand_code = $brand[0]['code'];
        $brand_name = $brand[0]['text'];



        $request->merge(["brand_id" => $brand_id]);
        $request->merge(["procedure_id" => $procedure_id]);
        

        $validator = Validator::make($request->all(), [
            'brand_id' => 'required|integer|exists:brands,id',
            'procedure_id' => 'required|integer|exists:procedures,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray(),
                'refresh' => true,
            ]);
        }


        $testimonial = Testimonial::where('brand_id', $brand_id)
        ->where('procedure_id', $procedure_id)
        ->get();

        $procedure = Procedure::select('*', "procedure_$lang as procedure")->find($procedure_id);
        $brand = Brand::find($brand_id);
        

        return response()->json([
            'testimonial' => $testimonial,
            'procedure' => $procedure,
            'brand' => $brand,
            'image' => $testimonial->load('imageOne'),
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    public function updateOrder(Request $request)
    {

        $lang = Auth::guard('staff')->user()->lang;
        $procedure = json_decode($request->procedure, true);
        $procedure_id = $procedure[0]['id'] ;
        $procedure_code = $procedure[0]['code'];
        $procedure_name = $procedure[0]['text'];
        $brand = json_decode($request->brand, true);
        $brand_id = $brand[0]['id'] ;
        $brand_code = $brand[0]['code'];
        $brand_name = $brand[0]['text'];
         $testimonials = Testimonial::where('brand_id', $brand_id)
         ->where('procedure_id', $procedure_id)
         ->get();

       foreach ($testimonials as $k => $testimonial) {
           $testimonial->order = ($k +1);
           $testimonial->save();
       }
         return($testimonials);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestimonialRequest  $request
     * @param  \App\Models\Staff\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $testimonial = Testimonial::where('code', $request->id)->with(['imageOne'])->first();
        if ($testimonial) {
            $order = $testimonial->order;
            $testimonial->forceDelete();
            self::destroyMedia($testimonial, false, true);
        }

        return $testimonial;
    }
    protected function destroyMedia($model, $video, $image)
    {
        if ($image) {
            if ($model->imageOne) {
                $lastPhoto = $model->imageOne->image;
                $lastPhotoId = $model->imageOne->id;
            }
            if (!is_null($lastPhoto)) {
                unlink(public_path($lastPhoto));
                $model->imageOne->forceDelete($lastPhotoId);
            }
        }
        if ($video) {
           if ($model->videoOne) {
                $lastVideo = $model->videoOne->video;
                $lastVideoId = $model->videoOne->id;
            }
            if (!is_null($lastVideo)) {
                unlink(public_path($lastVideo));
                $model->videoOne->forceDelete($lastVideoId);
            }
        }
    }
}

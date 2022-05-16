<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Staff\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Lang;

class SliderController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:staff');
    }
    public function index()
    {
        $slider = Slider::with(["imageOne", "videoOne"])->orderBy('order', 'ASC')->get();
        
        return view('staff.page-settings.slider', ["slider" => $slider]);
    }

    public function updateOrder()
    {
       $sliders = Slider::all();

       foreach ($sliders as $k => $slide) {
           $slide->order = ($k +1);
           $slide->save();
       }
    }
    public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'slogan' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $slider = new Slider();
        $slider->order =$request->order;
        $slider->title =$request->title;
        $slider->slogan = ($request->slogan != "")? $request->slogan:null;
        $slider->code = getCode();
        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = storage_path('app/public').'/page/slider/image';
            $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = 1920;
            $height = 1152;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '100');
            $image = "storage/page/slider/image/$img_name";
            $img->destroy();
        }
        $video ="";
        $mime = "";
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $mime = $video->getMimeType();
            $destinationPath = storage_path('app/public').'/page/slider/video';
            $vid_name = time().uniqid(Str::random(30)).'.'.$video->getClientOriginalExtension();
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);
            $video->move($destinationPath, $vid_name);
            $video = "storage/page/slider/video/$vid_name";
        }
        if ($slider->save()) {
            $slider->imageOne()->create(
                ['image' => $image, 'code' => getCode()]
            ); 
            $slider->videoOne()->create(
                ['video' => $video, 'mime' => $mime, 'code' =>  getCode()]
            );

            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => 'New slider was successfully created!',
                    'reload' => true,
                    "video" => $video,
                    "image" => $image,
                    "order" => $request->order,
                    'slider' => $slider,
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the slider please try again!'),
                'reload' => false,
            ]
        );
    }

    public function update(Request $request)
    {
        //return $request;
        $slider = Slider::where('code', $request->code)->with(['imageOne', 'videoOne'])->first();
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'order' => 'integer|required',
            'slogan' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'video' => 'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $slider->order = $request->order;
        $slider->title = $request->title;
        $slider->slogan = ($request->slogan != "")? $request->slogan:null;
        $slider->code = getCode();

        $lastPhoto = null;
        $lastVideo = null;
        $image;
        $video;
        if ($slider->imageOne) {
            $lastPhoto = $slider->imageOne->image;
            $lastPhotoId = $slider->imageOne->id;
        }
        if ($slider->videoOne) {
            $lastVideo = $slider->videoOne->video;
            $lastVideoId = $slider->videoOne->id;
        }

        if ($slider->save()) {
            $image = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $destinationPath = storage_path('app/public').'/page/slider/image';
                $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $width = 1920;
                $height = 1152;
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

                self::destroyMedia($slider, false, true);

                $img->save($destinationPath."/".$img_name, '100');
                $image = "storage/page/slider/image/$img_name";
                $img->destroy();
            }
            $video ="";
            $mime = "";
            if ($request->hasFile('video')) {
                $video = $request->file('video');
                $mime = $video->getMimeType();
                $destinationPath = storage_path('app/public').'/page/slider/video';
                $vid_name = time().uniqid(Str::random(30)).'.'.$video->getClientOriginalExtension();
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

                self::destroyMedia($slider, true, false);
                $video->move($destinationPath, $vid_name);
                $video = "storage/page/slider/video/$vid_name";
            }

            $slider->imageOne()->create(
                ['image' => $image, 'code' => getCode()]
            ); 
            $slider->videoOne()->create(
                ['video' => $video, 'mime' => $mime, 'code' =>  getCode()]
            );

            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => 'New slider was successfully created!',
                    'reload' => true,
                    "video" => $video,
                    "image" => $image,
                    "order" => $request->order,
                    'slider' => $slider,
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'We couldn’t update the slider please try again!',
                'reload' => false,
            ]
        );

    }
    public function destroy(Request $request)
    {
        $slider = Slider::where('code', $request->id)->with(['imageOne', 'videoOne'])->first();

        if ($slider) {
            $order = $slider->order;
            $slider->forceDelete();
            self::updateOrder();
            self::destroyMedia($slider, true, true);
        }

        return response()->json([
            'icon' => 'success',
            'msg' => 'Slider was deleted successfully',
            'reload' => true,
            'order' => $order
        ]);
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

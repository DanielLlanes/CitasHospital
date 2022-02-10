<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:staff');
        $this->middleware('can:brand.list')->only(['getBrandList', 'brand']);
        $this->middleware('can:brand.edit')->only(['edit','update']);
        $this->middleware('can:brand.create')->only(['create','store']);
        $this->middleware('can:brand.destroy')->only(['destroy']);
        $this->middleware('can:brand.activate')->only(['activate']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function brand()
    {
        $lang = Auth::guard('staff')->user()->lang;
        app()->setLocale($lang);

        
        return view('staff.brand-manager.list');
    }

    public function getBrandList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $brands = Brand::with('imageOne')->select(["*", "description_$lang AS description" ])->get();
            return DataTables::of($brands)
                ->addIndexColumn()
                ->addColumn('image', function($brands){
                    if (is_null($brands->imageOne)) {
                        $images = "/siteFiles/assets/img/brands/".Str::of($brands->brand)->slug("-")->limit(50).".jpg";
                    } else {
                        $images = $brands->imageOne->image;
                    }
                    $image ='
                            <a href="'.asset($images).'" data-effect="mfp-zoom-in" class="a">
                                <img src="'.asset($images).'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$brands->name.'"/>
                            </a>
                        ';
                        return $image;
                })
                ->addColumn('brand', function($brands){
                    return '<span class"text-uppercase" style="font-weight: 500; color: '.$brands->color.'">'.$brands->brand.'</span>';;
                })
                ->addColumn('acronym', function($brands){
                    return $brands->acronym;
                })
                ->addColumn('color', function($brands){
                    return '<i class="fa fa-circle" style="color: '.$brands->color.'" aria-hidden="true"></i>';
                })
                ->addColumn('description', function($brands){
                    return $brands->description;
                })
                ->addColumn('active', function($brand){
                    $table_active = 'table-active';
                    $brand_id = $brand->id;
                    $cursor = "pointer";

                    if ($brand->active == '1') {
                        $btn = '<span attr-id="'. $brand_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $brand_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.brand-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'image', 'brand', 'color', 'active', 'action'])
                ->make(true);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required|string',
            'acronym' => 'required|string',
            'color' =>  [
                'required',
                'unique:brands',
                'unique:staff',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
            ],
            'image' => "sometimes|image|mimes:jpg,png,jpeg",
            'description_en' => 'required|string',
            'description_en' => 'required|string',
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = storage_path('app/public').'/brand/image';
            $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = 580;
            $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '100');
            $image = "storage/brand/image/$img_name";
            $img->destroy();
        }

        $brand = New Brand;
        $brand->brand = $request->brand;
        $brand->acronym = $request->acronym;
        $brand->color = $request->color;
        $brand->description_en = $request->description_en;
        $brand->description_es = $request->description_es;
        $brand->url = Str::slug($request->brand, '-');
        $brand->code = time().uniqid(Str::random(30));

        if ($brand->save()) {
            if ($image != '') {
                $brand->imageOne()->create(
                    ['image' => $image, 'code' => time().uniqid(Str::random(30))]
                ); 
            }
            
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New brand was successfully created!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the brand please try again!'),
                'reload' => false
            ]
        );
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $brand = Brand::with('imageOne')->find($request->id);


        if ($brand) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $brand,
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'The selected brand doesn\'t exist in the database',
            ]
        );
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
        $brand = Brand::with('imageOne')->find($request->id);
        if ($brand) {
            $validator = Validator::make($request->all(), [
                'brand' => 'required|string',
                'acronym' => 'required|string',
                'color' =>  [
                    'required',
                    'unique:brands,color,'.$request->id.',id',
                    'unique:staff',
                    'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
                ],
                'description_en' => 'required|string',
                'description_en' => 'required|string',
              ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            $lastPhoto = null;
            $avatar;
            if (!$brand->imageOne) {
                $lastPhoto = $brand->imageOne->image;
                $lastPhotoId = $brand->imageOne->id;
            } 


            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $destinationPath = storage_path('app/public').'/brand/image';
                $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $width = 600;
                $height = 600;
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

                $img->save($destinationPath."/".$img_name, '100');
                $image = "storage/brand/image/$img_name";

                if (!is_null($lastPhoto)) {
                    //unlink(public_path($lastPhoto));
                }
                $brand->imageOne->delete($lastPhotoId);
                $brand->imageOne()->create(
                    ['image' => $image, 'code' => time().uniqid(Str::random(30))]
                );
                $img->destroy();
            }

            $brand->brand = $request->brand;
            $brand->acronym = $request->acronym;
            $brand->color = $request->color;
            $brand->description_en = $request->description_en;
            $brand->description_es = $request->description_es;
            $brand->url = Str::slug($request->brand, '-');
            $brand->code = time().uniqid(Str::random(30));

            if ($brand->save()) {
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => Lang::get('The brand was successfully edited!'),
                        'reload' => true
                    ]
                );
            }
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('We couldn\'t edit this brand, please try again later'),
                    'reload' => false
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The selected brand doesn\'t exist in the database'),
                'reload' => false
            ]
        );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $brand = Brand::with('imageOne')->find($request->id);
        if($brand->exists()){
            if (!$brand->imageOn) {
                $lastPhoto = $brand->imageOne->image;
                $lastPhotoId = $brand->imageOne->id;
                ////unlink(public_path($lastPhoto));
                $brand->imageOne->delete($lastPhotoId);
            } 
            
            $brand->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Brand successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Brand you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }
    public function activate(Request $request)
    {
        $brand = Brand::find($request->id);
        if ($brand) {
            if ($brand->active == 1) {
                $brand->active = false;
            } elseif ($brand->active == 0) {
                $brand->active = true;
            }
            $brand->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The brand status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected brand doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }
}

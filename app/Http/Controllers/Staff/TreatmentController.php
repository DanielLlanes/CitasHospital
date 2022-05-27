<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff\Contain;
use App\Models\Staff\Procedure;
use App\Models\Staff\Service;
use App\Models\Staff\Treatment;
use App\Models\Staff\imageOne;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class TreatmentController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:staff');
        $this->middleware('can:treatment.list')->only(['getPackageList', 'treatments']);
        $this->middleware('can:treatment.edit')->only(['edit','update']);
        $this->middleware('can:treatment.create')->only(['create','store']);
        $this->middleware('can:treatment.destroy')->only(['destroy']);
        $this->middleware('can:treatment.activate')->only(['activate']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function treatments()
    {
        $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();
        $treatment = Treatment::selectRaw("id, brand_id, service_id, procedure_id, package_id, price")
        ->with
        (
            [
                'brand' => function($q) use ($lang){
                    $q->selectRaw("id, brand, color");
                },
                'service' => function($q) use ($lang){
                    $q->selectRaw("id, service_$lang service");
                },
                'procedure' => function($q) use ($lang){
                    $q->selectRaw("id, procedure_$lang procedur");
                },
                'package' => function($q) use ($lang){
                    $q->selectRaw("id, package_$lang package");
                },
                'imageOne',
                'contains',
            ]
        )
        ->get();

        //return $treatment;

        return view('staff.treatments-manager.list');
    }

    public function getTreatmentsList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            $treatment = Treatment::with
            (
                [
                    'brand' => function($q) use ($lang){
                        $q->selectRaw("id, brand, color");
                    },
                    'service' => function($q) use ($lang){
                        $q->selectRaw("id, service_$lang service");
                    },
                    'procedure' => function($q) use ($lang){
                        $q->selectRaw("id, procedure_$lang procedur");
                    },
                    'package' => function($q) use ($lang){
                        $q->selectRaw("id, package_$lang package");
                    },
                ]
            )
            ->selectRaw("id, brand_id, service_id, procedure_id, package_id, price, active")
            ->orderBy('service_id', "asc")
            ->orderBy('procedure_id', 'asc')
            ->get();
            return DataTables::of($treatment)
                ->addIndexColumn()
                ->addColumn('brand', function($treatment){
                    return '<span style="font-size: .7vw; font-weight: 800; color: '.$treatment->brand->color.'">'.strtoupper($treatment->brand->brand).'</span>';
                })
                ->addColumn('service', function($treatment){
                    return $treatment->service->service;
                })
                ->addColumn('procedure', function($treatment){
                    return $treatment->procedure->procedur;
                })
                ->addColumn('package', function($treatment){
                    if (!is_null($treatment->package_id)) {
                        return $treatment->package->package;
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('price', function($treatment){
                    if (is_null($treatment->price) || $treatment->price == '') {
                        return 'Por cotizar';
                    } else {
                        return "$ $treatment->price";
                    }
                })
                ->addColumn('active', function($treatment){
                    $table_active = 'table-active';
                    $products_id = $treatment->id;
                    $cursor = "pointer";

                    if ($treatment->active == '1') {
                        $btn = '<span attr-id="'. $products_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $products_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.treatments-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'brand', 'service', 'procedure', 'package', 'price', 'active', 'action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {

        //return($request);

        if ($request->image == 'undefined') {
            $request->request->remove('image');
        }
        $exist = false;
        if ($request->package == 0) {
            $exist = Treatment::where("procedure_id", $request->procedure)
            ->first();
        } else {
            $exist = Treatment::where("procedure_id", $request->procedure)
            ->where('package_id', $request->package)
            ->first();
        }



        if ($exist) {
            return response()->json(
                [
                    'exist' => $exist,
                    'icon' => 'error',
                    'msg' => Lang::get('This procedure already exist!'),
                    'reload' => false
                ]
            );
        }
        $has_package = Procedure::selectRaw("has_package")->find($request->procedure);

        $request->request->add(['has_package' => $has_package->has_package]);
        //return($request);

        $validator = Validator::make($request->all(), [
            'service' => 'required|integer|exists:services,id',
            'clave' => 'required|string|unique:treatments',
            'procedure' => 'required|integer|exists:procedures,id',
            'package' =>
            [
                'bail',
                'nullable',
                ($request->has_package == '1') ? 'exists:packages,id' : '',
                ($request->has_package == '1') ? 'required' : '',
            ],
            'price' => 'nullable|sometimes|numeric',
            'starting' => 'required|boolean',
            "discount" => "sometimes|nullable|numeric",
            'discountType' => 
            [
                ($request->has('discount')) ? 'required' : '',
                ($request->has('discount')) ? "in:money,porcent" : '',

            ],
        ]);
        //return $request;
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
            $destinationPath = storage_path('app/public').'/treatment/image';
            $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = 580;
            $height = null;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '100');
            $image = "storage/treatment/image/$img_name";
            $img->destroy();
        }

        $group = Procedure::find($request->procedure);

        $getBrand = Service::select('brand_id')
        ->find($request->service);

        $contains_en = json_decode($request->includes_en);
        $contains_es = json_decode($request->includes_es);


        $treatment = new Treatment;
        $treatment->brand_id = $getBrand->brand_id;
        $treatment->service_id = $request->service;
        $treatment->procedure_id = $request->procedure;
        $treatment->package_id = ($request->has_package == '1') ? $request->package : null;
        $treatment->price = $request->price;
        $treatment->clave = $request->clave;
        $treatment->group_es = $group->procedure_es;
        $treatment->group_en = $group->procedure_en;
        $treatment->code = time().uniqid(Str::random(30));
        $treatment->discount = ($request->has('discount')) ? $request->discount : null;
        $treatment->discountType = ($request->has('discount')) ? $request->discountType : null;
        $treatment->starting = $request->starting;

        $contains = new Collection;
        for ($i = 0; $i < count($contains_en); $i++) {
            if ($contains_en[$i]->include_en != '' ||  $contains_es[$i]->include_es != '') {
                   $contains->push((object)[
                       'contain_en' => $contains_en[$i]->include_en,
                       'contain_es' => $contains_es[$i]->include_es,
                   ]);
            }
        }

        if ($treatment->save()) {
            if ($image != '') {
                $treatment->imageOne()->create(
                    ['image' => $image, 'code' => time().uniqid(Str::random(30))]
                );
            }
            foreach ($contains as $k => $con) {
                $treatment->contains()->create([
                    'contain_en' => $con->contain_en,
                    'contain_es' => $con->contain_es,
                    "code" => getCode(),
                    "order" => $k
                ]);
            }
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New Treatment was successfully created!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the Treatment please try again!'),
                'reload' => false
            ]
        );

    }

    public function edit(Request $request)
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $treatment = Treatment::with
            (
                [
                    'brand' => function($q) use ($lang){
                        $q->selectRaw("id, brand, color");
                    },
                    'service' => function($q) use ($lang){
                        $q->selectRaw("id, service_$lang service");
                    },
                    'procedure' => function($q) use ($lang){
                        $q->selectRaw("id, procedure_$lang procedur");
                    },
                    'package' => function($q) use ($lang){
                        $q->selectRaw("id, package_$lang package");
                    },
                    'imageOne',
                    'contains',
                ]
            )
            ->selectRaw("*")
            ->find($request->id);


        if ($treatment) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $treatment,
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'The selected Treatment doesn\'t exist in the database',
            ]
        );
    }

    public function update(Request $request)
    {
        //return $request;
        if ($request->image == 'undefined') {
            $request->request->remove('image');
        }

        $treatment = Treatment::with('imageOne')->find($request->id);
        if (!$treatment) {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get("This treatment doesn't exist!"),
                    'reload' => false
                ]
            );
        }

        $exist = false;
        if ($request->package == 0) {
            $exist = Treatment::where("procedure_id", $request->procedure)
            ->where('id', '<>', $request->id)
            ->first();
        } else {
            $exist = Treatment::where("procedure_id", $request->procedure)
            ->where('package_id', $request->package)
            ->where('id', '<>', $request->id)
            ->first();
        }

        if ($exist) {
            return response()->json(
                [
                    'exist' => $exist,
                    'icon' => 'error',
                    'msg' => Lang::get('This procedure already exist!'),
                    'reload' => false
                ]
            );
        }
        $has_package = Procedure::selectRaw("has_package")
        ->find($request->procedure);
        $request->request->add(['has_package' => $has_package->has_package]);

        $validator = Validator::make($request->all(), [
            'service' => 'required|integer|exists:services,id',
            'clave' => 'required|string|unique:treatments,clave,'.$request->id,
            'procedure' => 'required|integer|exists:procedures,id',
            'package' =>
            [
                'bail',
                'required_if:has_package,0',
                'nullable',
                ($request->has_package == '1') ? 'exists:packages,id' : '',
            ],
            'price' => 'nullable|sometimes|numeric',
            'starting' => 'required|boolean',
            "discount" => "sometimes|nullable|numeric",
            'discountType' => 
                [
                    ($request->has('discount')) ? 'required' : '',
                    ($request->has('discount')) ? "in:money,porcent" : '',
                ],

            'image' => "nullable|sometimes|image|mimes:jpg,png,jpeg",
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
        $lastPhotoId = null;
        $avatar;

        if ($treatment->imageOne) {
            $lastPhoto = $treatment->imageOne->image;
            $lastPhotoId = $treatment->imageOne->id;
            //return response()->json(['xD' => 'paso']);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = storage_path('app/public').'/treatment/image';
            $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = 600;
            $height = 600;
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '100');
            $image = "storage/treatment/image/$img_name";

            $imageExist = $treatment->imageOne()->where('id', $lastPhotoId)->first();


            if (!is_null($lastPhotoId)) {
               $treatment->imageOne->delete($lastPhotoId);
            }

            $treatment->imageOne()->create(
                ['image' => $image, 'code' => time().uniqid(Str::random(30))]
            );
            $img->destroy();
        }

        $group = Procedure::find($request->procedure);

        $getBrand = Service::select('brand_id')
        ->find($request->service);

        $treatment = Treatment::find($request->id);
        $treatment->brand_id = $getBrand->brand_id;
        $treatment->service_id = $request->service;
        $treatment->procedure_id = $request->procedure;
        $treatment->package_id = ($request->has_package == '1') ? $request->package : null;
        $treatment->price = $request->price;
        $treatment->clave = $request->clave;
        $treatment->group_es = $group->procedure_es;
        $treatment->group_en = $group->procedure_en;
        $treatment->code = getCode();
        $treatment->discount = ($request->has('discount')) ? $request->discount : null;
        $treatment->discountType = ($request->has('discount')) ? $request->discountType : null;;
        $treatment->starting = $request->starting;

        $contains_en = json_decode($request->includes_en);
        $contains_es = json_decode($request->includes_es);

        $contains = new Collection;
        for ($i = 0; $i < count($contains_en); $i++) {
            if ($contains_en[$i]->include_en != '' ||  $contains_es[$i]->include_es != '') {
                   $contains->push((object)[
                       'contain_en' => $contains_en[$i]->include_en,
                       'contain_es' => $contains_es[$i]->include_es,
                   ]);
            }
        }
        $treatment->contains()->delete();
        foreach ($contains as $k => $con) {
            $treatment->contains()->create([
                'contain_en' => $con->contain_en,
                'contain_es' => $con->contain_es,
                "code" => getCode(),
                "order" => $k
            ]);
        }

        if ($treatment->save()) {


            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The Treatment was successfully edited!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t edit this Treatment please try again!'),
                'reload' => false
            ]
        );
    }

    public function destroy(Request $request)
    {
        $treatment = Treatment::with('imageOne', 'contains')->find($request->id);
        if($treatment->exists()){
            if (!$treatment->imageOn) {
                $lastPhoto = $treatment->imageOne->image;
                $lastPhotoId = $treatment->imageOne->id;
                //unlink(public_path($lastPhoto));
                $treatment->contains()->delete();
                $treatment->imageOne->delete($lastPhotoId);
            }
            $treatment->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Treatment successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Treatment you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }

    // public function imageDestroy(Request $request)
    // {
    //     return $request;

    //     $treatment = Treatment::with('imageOne')->find($request->treatment);
    //     return($treatment);

    //     if ($treatment) {
    //         $imageExist = $treatment->imageOne()->where('id', $request->id_image)->first();
    //         return($imageExist);

    //         if ($imageExist) {
    //             if ($imageExist == $request->id_code) {
    //                 $lastPhoto = $treatment->imageOne->image;
    //                 $lastPhotoId = $treatment->imageOne->id;
    //                 $imageExist->delete();
    //                 $treatment->imageOne->delete($request->treatment);
    //                 // if( file_exists($lastPhoto) ){
    //                 //     unlink(public_path($lastPhoto));
    //                 // }
    //             }
    //         }
    //     }

    //     return response()->json(['x' => 1]);
    // }

    public function activate(Request $request)
    {
        $treatment = Treatment::find($request->id);

        if ($treatment) {
            if ($treatment->active == 1) {
                $treatment->active = false;
            } elseif ($treatment->active == 0) {
                $treatment->active = true;
            }
            $treatment->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The Treatment status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected Treatment doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }
}

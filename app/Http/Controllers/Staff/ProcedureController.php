<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Staff\Package;
use App\Models\Staff\Service;
use App\Models\Staff\Procedure;
use App\Models\Staff\Specialty;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ProcedureController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('America/Tijuana');
        $this->middleware('auth:staff');
        $this->middleware('can:procedures.list')->only(['getProcedureList', 'procedure']);
        $this->middleware('can:procedures.edit')->only(['edit','update']);
        $this->middleware('can:procedures.create')->only(['create','store']);
        $this->middleware('can:procedures.destroy')->only(['destroy']);
        $this->middleware('can:procedures.activate')->only(['activate']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function procedure()
    {
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();

        $packages = Package::where('active', '=', '1')
        ->select('id', "package_$lang AS name")
        ->get();

        $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            $procedures = Procedure::select("*", "procedure_$lang as procedure")
            ->with(
                [
                    'imageOne',
                    'service' => function($q) use ($lang){
                        $q->select("id", "brand_id", "service_$lang as service")
                        ->with(
                            [
                                'brand' => function($q) use ($lang){
                                    $q->select("id", "brand", "color");
                                }
                            ]
                        );
                    },
                    'descriptionOne' => function($q)use($lang){
                        $q->select('*', "description_$lang as description");
                    }
                ]
            )
            ->get();

            //return $procedures;

        return view('staff.procedure-manager.list', ["packages" => $packages]);
    }

    public function getProcedureList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            $procedures = Procedure::select("*", "procedure_$lang as procedure")
            ->with(
                [
                    'imageOne',
                    'service' => function($q) use ($lang){
                        $q->select("id", "brand_id", "service_$lang as service")
                        ->with(
                            [
                                'brand' => function($q) use ($lang){
                                    $q->select("id", "brand", "color");
                                }
                            ]
                        );
                    },
                    'descriptionOne' => function($q)use($lang){
                        $q->select('*', "description_$lang as description");
                    }
                ]
            )
            ->get();
            return DataTables::of($procedures)
                ->addIndexColumn()
                ->addColumn('image', function($staff){
                    if (is_null($staff->imageOne)) {
                       $avatar ='
                                <a href="'.asset("staffFiles/assets/img/treatment/no-image-available.jpeg").'" data-effect="mfp-zoom-in" class="a">
                                    <img src="'.asset("staffFiles/assets/img/treatment/no-image-available.jpeg").'" class="img-thumbnail" alt="'.$staff->name.'"/>
                                </a>
                            ';
                    } else {
                        $avatar = '
                                    <a href="'.asset($staff->imageOne->image).'" data-effect="mfp-zoom-in" class="a">
                                        <img src="'.asset($staff->imageOne->image).'" class="img-thumbnail" alt="'.$staff->name.'"/>
                                    </a>
                                ';
                    }
                    return $avatar;
                })
                ->addColumn('brand', function($procedures){
                    return '<span style="font-weight: 500; color: '.$procedures->service->brand->color.'">'.$procedures->service->brand->brand.'</span>';
                })
                ->addColumn('service', function($procedures){
                    return $procedures->service->service;
                })
                ->addColumn('procedure', function($procedures){
                    return $procedures->procedure;
                })
                ->addColumn('haspackage', function($procedures){
                    $has_package = "";
                    if ($procedures->has_package == 1) {
                        $has_package = "Yes";
                    } else {
                        $has_package = "No";
                    }
                    return $has_package;
                })
                ->addColumn('description', function($procedures){
                    if (is_null($procedures->descriptionOne)) {
                        return '--------';
                     }
                     $char = 100;
                     $string = $procedures->descriptionOne->description;
                     //return($procedures->descriptionOne->description_es);
                     return  getStracto($string, $char);
                })
                ->addColumn('active', function($procedures){
                    $table_active = 'table-active';
                    $procedure_id = $procedures->id;
                    $cursor = "pointer";

                    if ($procedures->active == '1') {
                        $btn = '<span attr-id="'. $procedure_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $procedure_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.procedure-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'image', 'brand', 'service', 'procedure', 'haspackage', 'description', 'active', 'action'])
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
        $request->merge(['input_packages' => json_decode($request->input_packages, true)]);
        $validator = Validator::make($request->all(), [
            'service' => 'required|exists:services,id',
            'procedure_en' => 'required|string|unique:procedures',
            'procedure_es' => 'required|string|unique:procedures',
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'has_package' => 'required|integer',
            'image' => "nullable|sometimes|image|mimes:jpg,png,jpeg",
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => $request,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            return($image);
            $destinationPath = storage_path('app/public').'/procedure/image';
            $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = 1024;
            $height = 684;
            
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '100');
            $image = "storage/procedure/image/$img_name";
            $img->destroy();
        }

        $procedure = new Procedure;
        $procedure->service_id = $request->service;
        $procedure->procedure_en = $request->procedure_en;
        $procedure->procedure_es = $request->procedure_es;
        $procedure->has_package = $request->has_package;
        $procedure->code = time().uniqid(Str::random(30));

        if ($procedure->save()) {
            if ($image != '') {
                $procedure->imageOne()->create(
                    ['image' => $image, 'code' => time().uniqid(Str::random(30))]
                );
            }
            $procedure->descriptionOne()->create([
                'description_es' => $request->description_es,
                'description_en' => $request->description_en,
                'code' => getCode(),

            ]);
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New procedure was successfully created!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the procedure please try again!'),
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
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $procedure = Procedure::with(
            [
                'imageOne',
                'service' => function($q) use ($lang){
                    $q->select("id", "brand_id", "service_$lang as service");
                },
                'descriptionOne' => function($q)use($lang){
                    $q->select('*', "description_$lang as description");
                }

            ]
        )
        ->find($request->id);


        if ($procedure) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $procedure,
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
        $procedure = Procedure::with('descriptionOne')->find($request->id);

        $validator = Validator::make($request->all(), [
            'service' => 'required|exists:services,id',
            'procedure_en' => 'required|string|unique:procedures,procedure_en,'.$request->id,
            'procedure_es' => 'required|string|unique:procedures,procedure_es,'.$request->id,
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'has_package' => 'required|integer',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => $request,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $procedure->service_id = $request->service;
        $procedure->procedure_en = $request->procedure_en;
        $procedure->procedure_es = $request->procedure_es;
        $procedure->has_package = $request->has_package;
        $procedure->code = time().uniqid(Str::random(30));

        $lastPhoto = null;
        $lastPhotoId = null;
        $avatar;

        if ($procedure->imageOne) {
            $lastPhoto = $procedure->imageOne->image;
            $lastPhotoId = $procedure->imageOne->id;
            //return response()->json(['xD' => 'paso']);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = storage_path('app/public').'/procedure/image';
            $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $width = 1024;
            $height = 684;
            
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

            $img->save($destinationPath."/".$img_name, '90');
            $image = "storage/procedure/image/$img_name";

            $imageExist = $procedure->imageOne()->where('id', $lastPhotoId)->first();


            if (!is_null($lastPhotoId)) {
               $procedure->imageOne->delete($lastPhotoId);
            }

            $procedure->imageOne()->create(
                ['image' => $image, 'code' => time().uniqid(Str::random(30))]
            );
            $img->destroy();
        }
        
        if ($procedure->save()) {
            if (!is_null($procedure->descriptionOne)) {
                $procedure->descriptionOne()->delete();
            }
            $procedure->descriptionOne()->create([
                'description_en' => $request->description_en,
                'description_es' => $request->description_es,
                'code' => getCode(),
            ]);
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The procedure was successfully updated!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the procedure please try again!'),
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
        $procedure = Procedure::with('descriptionOne')->find($request->id);
        if($procedure->exists()){
            $procedure->descriptionOne()->delete();
            $procedure->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Procedure successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Procedure you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }

    public function activate(Request $request)
    {
        $procedire = Procedure::find($request->id);
        if ($procedire) {
            if ($procedire->active == 1) {
                $procedire->active = false;
            } elseif ($procedire->active == 0) {
                $procedire->active = true;
            }
            $procedire->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The procedure status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected procedure doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }
    public function imageDestroy(Request $request)
    {
        //return $request;

        $procedure = Procedure::with('imageOne')->find($request->procedure);
        //return($procedure);

        if ($procedure) {
            $imageExist = $procedure->imageOne()->where('id', $request->id_image)->first();
            //return($imageExist);

            if ($imageExist) {
                if ($imageExist->code == $request->id_code) {
                   //return($imageExist);
                    $lastPhoto = $procedure->imageOne->image;
                    $lastPhotoId = $procedure->imageOne->id;
                    $procedure->imageOne()->delete($lastPhotoId);
                    //$imageExist->delete();
                    // if( file_exists($lastPhoto) ){
                    //     unlink(public_path($lastPhoto));
                    // }
                }
                    
            }
        }

        return response()->json(['x' => 1]);
    }
}

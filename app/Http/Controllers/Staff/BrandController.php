<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
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
    public function brand()
    {
        return view('staff.brand-manager.list');
    }

    public function getBrandList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $brands = Brand::select(["*", "description_$lang AS description" ])->get();
            return DataTables::of($brands)
                ->addIndexColumn()
                ->addColumn('picture', function($brands){
                    if (is_null($brands->image)) {
                       $image ='
                                <a href="'.asset("staffFiles/assets/img/user/user.jpg").'" data-effect="mfp-zoom-in" class="a">
                                    <img src="'.asset("staffFiles/assets/img/user/user.jpg").'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$brands->name.'"/>
                                </a>
                            ';
                    } else {
                        $image = '
                                    <a href="'.asset($brands->image).'" data-effect="mfp-zoom-in" class="a">
                                        <img src="'.asset($brands->image).'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$brands->name.'"/>
                                    </a>
                                ';
                    }
                    return $image;
                })
                ->addColumn('brand', function($brands){
                    return $brands->brand;
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
                ->rawColumns(['DT_RowIndex', 'picture', 'brand', 'color', 'active', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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

        $brand = New Brand;

        $brand->brand = $request->brand;
        $brand->acronym = $request->acronym;
        $brand->color = $request->color;
        $brand->description_en = $request->description_en;
        $brand->description_es = $request->description_es;

        if ($brand->save()) {
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
    public function edit(Request $request)
    {

        $brand = Brand::find($request->id);


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
        
        $brand = Brand::find($request->id);
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

            $brand->brand = $request->brand;
            $brand->acronym = $request->acronym;
            $brand->color = $request->color;
            $brand->description_en = $request->description_en;
            $brand->description_es = $request->description_es;

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
        $brand = Brand::find($request->id);
        if($brand->exists()){
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

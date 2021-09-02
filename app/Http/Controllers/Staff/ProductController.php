<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Staff\Product;
use App\Models\Staff\Service;
use App\Models\Staff\Procedure;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
    public function products()
    {
        $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);
        $products = Product::selectRaw("id, brand_id, service_id, procedure_id, package_id, price, description_$lang description")
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
            ]
        )
        ->get();

        //return $products;

        return view('staff.products-manager.list');
    }

    public function getProductList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $products = Product::with
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
            ->selectRaw("id, brand_id, service_id, procedure_id, package_id, price, active, description_$lang description")
            ->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('brand', function($products){
                    return '<span style="font-size: .7vw; font-weight: 800; color: '.$products->brand->color.'">'.strtoupper($products->brand->brand).'</span>';
                })
                ->addColumn('service', function($products){
                    return $products->service->service;
                })
                ->addColumn('procedure', function($products){
                    return $products->procedure->procedur;
                })
                ->addColumn('package', function($products){
                    if (!is_null($products->package_id)) {
                        return $products->package->package;
                    } else {
                        return 'N/A';
                    }
                })
                ->addColumn('price', function($products){
                    if (is_null($products->price) || $products->price == '') {
                        return 'Por cotizar';
                    } else {
                        return "$ $products->price";
                    }
                })
                ->addColumn('description', function($products){
                    return $products->description;
                })
                ->addColumn('active', function($products){
                    $table_active = 'table-active';
                    $products_id = $products->id;
                    $cursor = "pointer";

                    if ($products->active == '1') {
                        $btn = '<span attr-id="'. $products_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $products_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.service-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'brand', 'service', 'procedure', 'package', 'price', 'description', 'active', 'action'])
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
        $exist = Product::where("procedure_id", $request->procedure)
        ->where('package_id', $request->package)
        ->first();
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
            'procedure' => 'required|integer|exists:procedures,id',
            'package' =>
            [
                'bail',
                'required_if:has_package,0',
                'nullable',
                ($request->has_package == '1') ? 'exists:packages,id' : '',
            ],
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'price' => 'sometimes|numeric'
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $group = Procedure::find($request->procedure);

        $getBrand = Service::select('brand_id')
        ->find($request->service);


        $products = new Product;
        $products->brand_id = $getBrand->brand_id;
        $products->service_id = $request->service;
        $products->procedure_id = $request->procedure;
        $products->package_id = ($request->has_package == '1') ? $request->package : null;
        $products->price = $request->price;
        $products->group_es = $group->procedure_es;
        $products->group_en = $group->procedure_en;
        $products->description_en = $request->description_en;
        $products->description_es = $request->description_es;

        if ($products->save()) {
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New product was successfully created!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the product please try again!'),
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
        app()->setLocale($lang);
        $product = Product::with
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
            ->selectRaw("*")
            ->find($request->id);


        if ($product) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $product,
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'The selected product doesn\'t exist in the database',
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

        $exist = Product::where("procedure_id", $request->procedure)
        ->where('package_id', $request->package)
        ->where('id', '<>', $request->id)
        ->first();

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
            'procedure' => 'required|integer|exists:procedures,id',
            'package' =>
            [
                'bail',
                'required_if:has_package,0',
                'nullable',
                ($request->has_package == '1') ? 'exists:packages,id' : '',
            ],
            'description_en' => 'required|string',
            'description_es' => 'required|string',
            'price' => 'sometimes|numeric'
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $group = Procedure::find($request->procedure);

        $products = Product::find($request->id);
        $products->brand_id = $request->brand;
        $products->service_id = $request->service;
        $products->procedure_id = $request->procedure;
        $products->package_id = ($request->has_package == '1') ? $request->package : null;
        $products->price = $request->price;
        $products->group_es = $group->procedure_es;
        $products->group_en = $group->procedure_en;
        $products->description_en = $request->description_en;
        $products->description_es = $request->description_es;

        if ($products->save()) {
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The product was successfully edited!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t edit this product please try again!'),
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
        $product = Product::find($request->id);
        if($product->exists()){
            $product->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Product successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Product you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }

    public function activate(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            if ($product->active == 1) {
                $product->active = false;
            } elseif ($product->active == 0) {
                $product->active = true;
            }
            $product->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The product status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected product doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }
}

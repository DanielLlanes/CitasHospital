<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('staff.products-manager.list');
    }

    public function getProductList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $service = Service::with([
                'specialties' => function($q) use ($lang){
                    $q->selectRaw("name_$lang specialty_name");
                },
                'brand' => function($q) use ($lang){
                    $q->selectRaw("id, brand, color");
                },
            ])
            ->selectRaw("id, service_$lang service, need_images, qty_images, active, description_$lang description, brand_id")
            ->get();
            return DataTables::of($service)
                ->addIndexColumn()
                ->addColumn('service', function($service){
                    return $service->service;
                })
                ->addColumn('brand', function($service){
                    return '<span style="font-weight: 500; color: '.$service->brand->color.'">'.$service->brand->brand.'</span>';
                })
                ->addColumn('need_images', function($service){
                    $need_images = '';
                    if ($service->need_images == 0) {
                        $need_images .= 'No';
                    } else {
                        $need_images .= 'Yes';
                    }
                    return $need_images;
                })
                ->addColumn('qty_images', function($service){
                    return $service->qty_images;
                })
                ->addColumn('description', function($service){
                    return $service->description;
                })
                ->addColumn('active', function($service){
                    $table_active = 'table-active';
                    $service_id = $service->id;
                    $cursor = "pointer";

                    if ($service->active == '1') {
                        $btn = '<span attr-id="'. $service_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $service_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.service-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'service', 'brand', 'need_images', 'qty_images', 'description', 'active', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

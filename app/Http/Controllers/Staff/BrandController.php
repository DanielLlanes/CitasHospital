<?php

namespace App\Http\Controllers\Staff;

use App\Models\Staff\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

            $brands = Brand::select(["id", "image", "name", "acronym", "color", "description_$lang AS description" ]);
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
                    return $avatar;
                })
                ->addColumn('name', function($brands){
                    return $brands->name;
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
                ->addColumn('action', 'brand.brand-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'picture', 'name', 'department', 'specialization', 'color', 'mobile', 'email', 'active', 'action'])
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

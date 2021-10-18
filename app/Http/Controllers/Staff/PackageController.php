<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Staff\Package;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
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
    public function package()
    {
        $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

        return view('staff.packages-manager.list');
    }

    public function getPackageList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            app()->setLocale($lang);

            $packages = Package::select(["id", "active",  "package_$lang As package" ])->get();
            return DataTables::of($packages)
                ->addIndexColumn()
                ->addColumn('package', function($packages){
                    return $packages->package;
                })
                ->addColumn('active', function($packages){
                    $table_active = 'table-active';
                    $package_id = $packages->id;
                    $cursor = "pointer";

                    if ($packages->active == '1') {
                        $btn = '<span attr-id="'. $package_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $package_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.packages-manager.actions-list')
                ->rawColumns(['DT_RowIndex', 'package', 'active', 'action'])
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
            'package_en' => 'required|string|unique:packages',
            'package_es' => 'required|string|unique:packages',
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $package = New Package;

        $package->package_en = $request->package_en;
        $package->package_es = $request->package_es;

        if ($package->save()) {
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('New package was successfully created!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('We couldn’t create the package please try again!'),
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
        $package = Package::find($request->id);


        if ($package) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $package,
                ]
            );
        }

        return response()->json(
            [
                'icon' => 'error',
                'msg' => 'The selected package doesn\'t exist in the database',
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
        $package = Package::find($request->id);
        if ($package) {
            $validator = Validator::make($request->all(),
                [
                    'package_en' => 'required|string|unique:packages,package_en,'.$request->id,
                    'package_es' => 'required|string|unique:packages,package_es,'.$request->id,
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            $package->package_en = $request->package_en;
            $package->package_es = $request->package_es;

            if ($package->save()) {
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => Lang::get('The package was successfully edited!'),
                        'reload' => true
                    ]
                );
            }
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('We couldn\'t edit this package, please try again later'),
                    'reload' => false
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The selected package doesn\'t exist in the database'),
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
        $package = Package::find($request->id);
        if($package->exists()){
            $package->delete();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('Package successfully removed!'),
                    'reload' => true
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The Package you are trying to delete doesn\'t exist or was previously deleted!'),
                'reload' => false
            ]
        );
    }

    public function activate(Request $request)
    {
        $package = Package::find($request->id);
        if ($package) {
            if ($package->active == 1) {
                $package->active = false;
            } elseif ($package->active == 0) {
                $package->active = true;
            }
            $package->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The Package status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected Package doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }
}

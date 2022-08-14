<?php

namespace App\Http\Controllers\Partners;


use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnersRequest;
use App\Http\Requests\UpdatePartnersRequest;
use App\Mail\ResetPasswordFromAdminMail;
use App\Mail\WelcomeNewPartner ;
use App\Models\Partners\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Yajra\DataTables\DataTables;

class PartnersController extends Controller
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
    
    public function index()
    {
        return view('staff.partners-manager.partners');
    }

    public function getPartnersList(Request $request)
    {
        if ($request->ajax()) {
            $lang = Auth::guard('staff')->user()->lang;
            $lang = app()->getLocale();

            $partner = Partner::with([
                'imageOne', 
            ])->select(["*" ])->get();


            return DataTables::of($partner)
                ->addIndexColumn()
                ->addColumn('image', function($partner){
                    if (is_null($partner->imageOne)) {
                        $avatar ='
                            <a href="'.asset("staffFiles/assets/img/user/user.jpg").'" data-effect="mfp-zoom-in" class="a">
                                <img src="'.asset("staffFiles/assets/img/user/user.jpg").'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$partner->name.'"/>
                            </a>
                        ';
                    } else {
                        $avatar = '
                            <a href="'.asset($partner->imageOne->image).'" data-effect="mfp-zoom-in" class="a">
                                <img src="'.asset($partner->imageOne->image).'" class="img-thumbnail" style="width:50px; height:50px" alt="'.$partner->name.'"/>
                            </a>
                        ';
                    }
                        return $avatar;
                })
                ->addColumn('partner', function($partner){
                    return '<span class="label label-sm text-capitalize">'.ucfirst($partner->name).'</span>';
                })
                ->addColumn('phone', function($partner){
                    return $partner->phone;
                })
                ->addColumn('èmail', function($partner){
                    return '<i class="fa fa-circle" style="èmail: '.$partner->email.'" aria-hidden="true"></i>';
                })
                ->addColumn('active', function($partner){
                    $table_active = 'table-active';
                    $partner_id = $partner->id;
                    $cursor = "pointer";

                    if ($partner->active == '1') {
                        $btn = '<span attr-id="'. $partner_id .'" data="0" class="badge badge-success bg-success waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Activo</span>';
                    } else {
                        $btn = '<span attr-id="'. $partner_id .'" data="1" class="badge badge-danger bg-danger waves-effect '.$table_active.'" style="border-radius:0;cursor:'. $cursor .'">Inactivo</span>';
                    }
                    return $btn;
                })
                ->addColumn('action', 'staff.partners-manager.actions')
                ->rawColumns(['DT_RowIndex', 'image', 'partner', 'color', 'active', 'action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartnersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->image == 'undefined') {
            $request->merge(["image" => null]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:partners,name',
            'company' => 'required|string|unique:partners',
            'website' => 'required|string|',
            'image' => "nullable|mimes:jpg,png,jpeg",
            'phone' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            'email' => 'required|email|unique:partners',
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $unHashPassword = Str::random(8);
        $partner = New Partner;

        $image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = storage_path('app/public').'/partner/image';
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
            $image = "storage/partner/image/$img_name";

            $img->destroy();
        }

        $partner->email = Str::of($request->email)->lower();
        $partner->password = Hash::make($unHashPassword);
        $partner->name = getUcWords($request->name);
        $partner->company = $request->company;
        $partner->website = $request->website;
        $partner->phone = $request->phone;
        $partner->code = time().uniqid(Str::random(30));

        if ($partner->save()) {
            if ($image != "") {
                $img->save($destinationPath."/".$img_name, '100');
                $partner->imageOne()->create(
                    ['image' => $image, 'code' => time().uniqid(Str::random(30))]
                );
            }
        }

        $dataMsg = array(
            'reciver' => $request->email,
            'reciverName' => $request->partner,
            'password' => $unHashPassword,
            'sender' => Auth::guard('staff')->user()->email,
            'senderName' => Auth::guard('staff')->user()->name,
        );


        Mail::send(new WelcomeNewPartner($dataMsg));

        return response()->json(
            [
                'icon' => 'success',
                'msg' => Lang::get('Partner created successfully'),
                'reload' => true
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\partners\Partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $partner = Partner::with('imageOne')->find($request->id);


        if ($partner) {
            return response()->json(
                [
                    'success' => true,
                    'info' => $partner,
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
     * @param  \App\Http\Requests\UpdatePartnersRequest  $request
     * @param  \App\Models\partners\Partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->image == 'undefined') {
            $request->merge(["image" => null]);
        }
        $partner = Partner::with('imageOne')->find($request->id);

        if ($partner) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|unique:partners,name,'.$partner->id.',id',
                'company' => 'required|string|unique:partners,company,'.$partner->id.",id",
                'website' => 'required|string|',
                'image' => "nullable|mimes:jpg,png,jpeg",
                'phone' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'email' => 'required|email|unique:partners,email,'.$partner->id.',id',
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
            if (!is_null($partner->imageOne)) {
                $lastPhoto = $partner->imageOne->image;
                $lastPhotoId = $partner->imageOne->id;
                
            } 


            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $destinationPath = storage_path('app/public').'/partner/image';
                $img_name = time().uniqid(Str::random(30)).'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath());
                $width = 1373;
                $height = 682;
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true);

                $img->save($destinationPath."/".$img_name, '100');
                $image = "storage/partner/image/$img_name";

                if (!is_null($lastPhoto)) {
                    //unlink(public_path($lastPhoto));
                    $partner->imageOne->delete($lastPhotoId);
                }
                
                $partner->imageOne()->create(
                    ['image' => $image, 'code' => time().uniqid(Str::random(30))]
                );
                $img->destroy();
            }

            $partner->email = Str::of($request->email)->lower();
            $partner->name = getUcWords($request->name);
            $partner->company = $request->company;
            $partner->website = $request->website;
            $partner->phone = $request->phone;
            $partner->code = time().uniqid(Str::random(30));

            if ($partner->save()) {
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => Lang::get('The partner was successfully edited!'),
                        'reload' => true
                    ]
                );
            }
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('We couldn\'t edit this partner, please try again later'),
                    'reload' => false
                ]
            );
        }
        return response()->json(
            [
                'icon' => 'error',
                'msg' => Lang::get('The selected partner doesn\'t exist in the database'),
                'reload' => false
            ]
        );
    }

    public function activate(Request $request)
    {
        $partner = Partner::find($request->id);
        if ($partner) {
            if ($partner->active == 1) {
                $partner->active = false;
            } elseif ($partner->active == 0) {
                $partner->active = true;
            }
            $partner->save();
            return response()->json(
                [
                    'icon' => 'success',
                    'msg' => Lang::get('The partner status changed successfully'),
                    'reload' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('The selected partner doesn\'t exist in the database'),
                    'reload' => false
                ]
            );
        }
    }

    public function resetPassword(Request $request)
    {
        //return($request);
        $lang = Auth::guard('staff')->user()->lang;
        $lang = app()->getLocale();
        $partner = Partner::find(1);

        $unHashPassword = Str::random(8);
        if ($partner) {
            $dataMsg = array(
                'reciver' => $partner->email,
                'reciverName' => $partner->name,
                'password' => $unHashPassword,
                'username' => $partner->username,
                'sender' => Auth::guard('staff')->user()->email,
                'senderName' => Auth::guard('staff')->user()->name,
                'lang' => 'es'
            );

            $partner->password = Hash::make($unHashPassword);

            if ($partner->save()) {
                Mail::send(new ResetPasswordFromAdminMail($dataMsg));
                return response()->json(
                    [
                        'icon' => 'success',
                        'msg' => Lang::get('Contraseña cambiada correctamente!'),
                        'reload' => true
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'icon' => 'error',
                    'msg' => Lang::get('No pudimos encontrar al usuario seleccionado!'),
                    'reload' => false
                ]
            );
        }
    }
}

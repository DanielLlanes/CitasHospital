<?php

namespace App\Http\Controllers\Partners;

use App\Http\Controllers\Controller;
use App\Models\Site\Country;
use App\Models\Site\State;
use App\Models\Staff\Brand;
use App\Models\Staff\Package;
use App\Models\Staff\Procedure;
use App\Models\Staff\Service;
use App\Models\Staff\Treatment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class PartnetsSiteController extends Controller
{
    
    public function index()
    {
        $lang = 'es';
        
        $countries = Country::where('active', 1)->orderBy('name', 'desc')->select("id", "name")->get();

        $treatment = Treatment::with
        (
            [
                'service' => function($query) use ($lang) {
                    $query->select('id', 'brand_id', "active", "service_$lang as service", "need_images", "qty_images")
                    ->with('brand');
                 },
                'procedure' => function($query) use ($lang) {
                    $query->select('id', "active", "has_package", "service_id", "procedure_$lang as procedure");
                 },
                'package' => function($query) use ($lang) {
                    $query->select('id', "active", "package_$lang as package");
                 }
            ]
        )
        ->where('active', true)
        ->select("id", "brand_id", "service_id", "procedure_id", "package_id", "price")
        ->get();

        $service = Service::with('procedures')->get();
        return($treatment);

        return view('partners.site.index', ['countries' => $countries, 'treatment', 'service' => $service, "treatment" => $treatment]);
    }
   
    public function store(Request $request)
    {
        
    }
    public function data(Request $request)
    {
        //return $request;
        if ($request->step == 0) {

            $exist = false;

            if ($request->package == 0) {
                $exist = Treatment::where("procedure_id", $request->procedure)
                            ->first();
            } else {
                $exist = Treatment::where("procedure_id", $request->procedure)
                           ->where('package_id', $request->package)
                           ->first();
            }

            if (!$exist) {
                return response()->json(
                    [
                        'exist' => false,
                        'icon' => 'error',
                        'msg' => Lang::get('Este procedimiento no existe'),
                        'reload' => false
                    ]
                );
            }
            $validator = Validator::make($request->all(), [
                'treatmentBefore' => 'required|boolean',
                'name' => 'required|string',
                'sex' => 'required|string|',
                'age' => 'required|numeric|between:18,99',
                'dob' => 'required|date',
                'phone' => ['unique:patients,phone', 'required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'mobile' => ['required', 'regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
                'email' => 'required|max:255|email|unique:patients,email',
                'address' => 'required',
                'country_id' => 'required|integer',
                'state_id' => 'required|integer',
                'city' => 'required|string',
                'zip' => 'required|string',
                'ecn' => 'required|string',
                'ecp' => ['required', 'different:phone', 'different:mobile','regex:%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'go' => '0',
                    'errors' => $validator->getMessageBag()->toArray()
                ]);
            }

            return response()->json([
                'success' => true,
                "go" => '1'
            ]);
        }
    }
    public function services(Request $request)
    {
        $lang = 'es';
        $treatment = Treatment::with
        (
            [
                'service' => function($query) use ($lang, $request) {
                    $query->select('id', 'brand_id', "active", "service_$lang as service", "need_images", "qty_images")
                    ->where("service_$lang",'like', "%".$request->search."%")
                    ->with('brand');
                 },
                'procedure' => function($query) use ($lang) {
                    $query->select('id', "active", "has_package", "service_id", "procedure_$lang as procedure");
                 },
                'package' => function($query) use ($lang) {
                    $query->select('id', "active", "package_$lang as package");
                 }
            ]
        )
        ->where('active', true)
        ->select("id", "brand_id", "service_id", "procedure_id", "package_id", "price")
        ->get();


        $services = Service::where("service_es",'like', "%".$request->search."%")
        ->has('treatments')
        ->get();
        return($services);


        $services = new Collection();

        foreach ($treatment as $t) {
            $services->push((object)[
                'service' => $t->service->service,
                'id' => $t->service->id,
            ]);
        }
        $services  = collect($services)->unique();
        return $services;
    }

    public function procedures(Request $request)
    {
        $lang = "es";

        if ($request->has('service')) {

            $search = Procedure::whereHas(

                    'treatment', function($query) use ($request, $lang)
                    {
                        $query->where('service_id', $request->service)
                        ->select(
                            [
                                "id", "procedure_$lang as procedure"
                            ]
                        );
                    }

            )
            ->where("procedure_$lang",'like', "%".$request->search."%")
            ->select('id', "procedure_$lang AS procedure", "has_package as package")
            ->get();
        } else {
            $search = Procedure::where("procedure_$lang",'like', "%".$request->search."%")
            ->select('id', "procedure_$lang AS procedure")
            ->get();
        }
        return $search;
    }

    public function packages(Request $request)
    {
        $lang = 'es';

        if ($request->has('procedure')) {

           $search = Package::whereHas(
                'treatment', function($query) use ($request, $lang)
                {
                    $query->where('procedure_id', $request->procedure)
                    ->select(
                        [
                            "id", "package_$lang as package"
                        ]
                    );
                }
           )
           ->where("package_$lang",'like', "%".$request->key."%")
            ->select('id', "package_$lang AS package")
            ->get();
           } else {
                $search = Procedure::where("package_$lang",'like', "%".$request->key."%")
                ->select('id', "package_$lang AS procedure")
                ->get();
        }
        return $search;
    }
    
    public function countries(Request $request)
    {
        $countries = Country::where('active', 1)
        ->where("name",'like', "%".$request->search."%")
                    ->select('id', "name")
                    ->get();

        return $countries;
    }

    public function states(Request $request)
    {
        if ($request->has('country')) {

            $search = State::where('country_id', $request->country)->where("name",'like', "%".$request->key."%")
            ->select('id', "name")
            ->get();
        }
        return $search;
    }
}

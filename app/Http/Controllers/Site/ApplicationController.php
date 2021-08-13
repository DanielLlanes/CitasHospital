<?php

namespace App\Http\Controllers\Site;

use App\Models\Site\Country;
use Illuminate\Http\Request;
use App\Models\Staff\Product;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{

    private $form_session = 'form_apps';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $lang = app()->getLocale();
        $exists = Product::where('active', true)
        ->findOrFail($id);

        $countries = Country::where('active', 1)->orderBy('name', 'desc')->select("id", "name")->get();

        $product = Product::with
        (
            [
                'service' => function($query) use ($lang) {
                    $query->select('id', "active", "service_$lang as service");
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
        ->findOrFail($id);

        if ($exists) {
            return view
            (
                'site.apps.patient-data',
                [
                    'product' => $product,
                    'countries' => $countries
                ]
            );
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

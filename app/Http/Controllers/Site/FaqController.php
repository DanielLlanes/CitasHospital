<?php

namespace App\Http\Controllers\Site;



use App\Http\Controllers\Controller;
use App\Models\Site\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('staff.page-settings.faqs', ['faqs' => $faqs]);
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
        $validator = Validator::make($request->all(), [
            'awnser_es' => 'required|string',
            'awnser_en' => 'required|string',
            'question_es' => 'required|string',
            'question_en' => 'required|string',
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $faq = new Faq;
        $faq->question_en = $request->question_en;
        $faq->awnser_en = $request->awnser_en;
        $faq->question_es = $request->question_es;
        $faq->awnser_es = $request->awnser_es;
        $faq->order = $request->order;
        $faq->code = getCode();

        if ($faq->save()) {
            return response()->json([
                'success' => true,
                'icon'=> 'success',
                'msg' => 'Faq agregada con exito',
                'faq' => $faq,
            ]);
        }

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
        $validator = Validator::make($request->all(), [
            'awnser_es' => 'required|string',
            'awnser_en' => 'required|string',
            'question_es' => 'required|string',
            'question_en' => 'required|string',
          ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'go' => '0',
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $faq = Faq::where('code', $request->code)->first();
        $faq->question_en = $request->question_en;
        $faq->awnser_en = $request->awnser_en;
        $faq->question_es = $request->question_es;
        $faq->awnser_es = $request->awnser_es;

        if ($faq->save()) {
            return response()->json([
                'success' => true,
                'icon' => 'success',
                'msg' => "Actualizado don exito",
                'faq' => $faq
            ]);
        }
    }

    public function activate(Request $request)
    {
        $faq = Faq::where('code', $request->code)->first();

       if ($faq) {
           if ($faq->active == 0) {
               $faq->active = 1;
           } else {
             $faq->active = 0;
           }
           if ($faq->save()) {
               return response()->json([
                    'success' => true,
                    'icon' => 'success',
                    'msg' => 'Acualizado con éxito',
                    'faq' => $faq
               ]);
           }
       } 
    }

    public function updateOrder(Request $request)
    {
        $arr = json_decode($request->obj, true);

        foreach ($arr as $k => $v) {
            $r = Faq::where('code', $v['code'])->first();
            $r->order = $v['order'];
            $r->save();
        }
        
        return response()->json([
            'success' => true,
            'icon' => 'success',
            'msg' => 'Reordenado con exito',
            'faqs' => $arr
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return response()->json($request);
        $faq = Faq::where('code', $request->code)->first();

        faq::find($faq->id)->forceDelete();

        $faqs = Faq::All();

        foreach ($faqs as $k => $faq) {
            $faq->order = ( $k + 1 );
            $faq->save();
        }
        return response()->json([
            'success' => true,
            'icon' => 'success',
            'msg' => 'Eliminado con exito',
            'faqs' => $faqs
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
       $faqs = Faq::orderBy('sort','desc')->paginate();
        if($request->api)
        {
            if(isset($request->search))
            $faqs = $this->filter(['table'=>'faqs','class'=>Faq::class,'search'=>$request->search]);
            return response()->json($faqs, 200);
        }
       return view('admin.faqs',compact('faqs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $faq = Faq::create($request->all());
        return response()->json($faq, 200);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = Faq::where('id',$id)->first();
        return response()->json($faq, 200);
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
        $faq = Faq::where('id',$id)->first();
        $faq->update($request->all());
        return response()->json($faq, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Faq::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

}

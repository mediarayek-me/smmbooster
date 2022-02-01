<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Models\LanguageValue;
use Illuminate\Support\Facades\Route;

class LanguageController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
       $languages = Language::orderBy('sort','desc')->paginate();
        if($request->api)
        {
            if(isset($request->search))
            $languages = $this->filter(['table'=>'languages','class'=>Language::class,'search'=>$request->search]);
            return response()->json($languages, 200);
        }
       return view('admin.languages',compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if($request->input('id')){
           return $this->update($request,$request->input('id'));
       }
       $request->validate([
            'name' => 'required',
            'status' => 'required',
            'is_default' => 'required',
            'image' => 'required',
            'sort' => 'required',
            'code' => 'required',
            'direction' => 'required'
        ]);
        
        $language = $request->all();
        $language['status'] = $language['status'] ? 'active' : 'deactive';
        $language['is_default'] = $language['is_default'] ? 'yes' : 'no';
        
        if( $language['is_default'] == 'yes')
        Language::where('id','>',0)->update(['is_default'=>'no']);
        
        if(!is_null($request->file('image')))
        {
            $imagename = time().'.'.$request->file('image')->getClientOriginalExtension();
            
            if($request->file('image')->move(public_path('images'),$imagename))
            $language['image'] = $imagename;

        }
        
        $language = Language::create($language);
        \Session::put('success_save',true);
        return redirect()->back();
   
    }

    /**
     * set language
     */

    public function setLanguage(Request $request)
    {
           if(!is_null($request->id))
           {
            session()->put('language_id', $request->id);
           }
        return back();
    }
    /**
     * store language values
     */

    public function storeValues(Request $request)
    {
        $keys = $request->key;
        $values = $request->value;
        $language_id = $request->language_id;
        $data = [];
        foreach ($keys as  $i => $key) {
           array_push($data,['key'=>$key,'value'=>$values[$i],'language_id'=>$language_id]);
        }
        LanguageValue::whereIn('key',$keys)->where('language_id',$language_id)->delete();
        LanguageValue::insert($data);
        \Session::put('success_save',true);
        return redirect()->back();

    }

    /**
     * get language keys
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::where('id',$id)->first();
        $keys = LanguageValue::where('language_id',$id)->orderBy('id','desc')->get();
        return view('admin.language_values',compact('keys','id','language'));  
    }

    public function showItem($id)
    {
        $language = Language::where('id',$id)->first();
        return response()->json($language, 200);
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
        if($id != 1)
        {
        $language = Language::where('id',$id)->first();
        $data = $request->all();
        if(isset($data['status']))
        {
            $data['status'] = $data['status'] === 'true' ? 'active' : 'deactive';
            $data['is_default'] = $data['is_default'] === 'true' ? 'yes' : 'no';
        }
        // dd($data);
        if($data['is_default'] === 'yes')
        {
            Language::where('id','>',0)->update(['is_default'=>'no']);
        }
        if($request->file('image'))
        {
            $imagename = time().'.'.$request->file('image')->getClientOriginalExtension();
            
            if($request->file('image')->move(public_path('images'),$imagename))
            $data['image'] = $imagename;
        }
        $data =  $language->update($data);

        $countDefault = Language::where('is_default','yes')->count();

        if($countDefault == 0)
        {
            Language::where('id',1)->update(['is_default'=>'yes']);
        }

        \Session::put('success_update',true);
       }
       return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != 1)
        {
        $destroy = Language::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
        }
        return response()->json(false, 301);
    } 
    
    public function deleteKey($id)
    {
        if($id)
        {
        $destroy = LanguageValue::where('id',$id)->delete();
        return response()->json($destroy, 200);
        }
        return response()->json(false, 301);
    }
    public function getLanguageValues($id)
    {
        if($id)
        {
            $data = LanguageValue::where('language_id',$id)->get()->pluck('value','key');
            return response()->json($data, 200);    
        }
    }

}

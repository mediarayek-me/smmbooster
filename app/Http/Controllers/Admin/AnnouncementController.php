<?php

namespace App\Http\Controllers\Admin;

use App\Traits\MainTrait;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
       $announcements = Announcement::orderBy('id','desc')->paginate();
        if($request->api)
        {
            if(isset($request->search))
            $announcements = $this->filter(['table'=>'announcements','class'=>Announcement::class,'search'=>$request->search]);
            return response()->json($announcements, 200);
        }
       return view('admin.announcements',compact('announcements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $announcement = Announcement::create($request->all());
        return response()->json($announcement, 200);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $announcement = Announcement::where('id',$id)->first();
        return response()->json($announcement, 200);
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
        $announcement = Announcement::where('id',$id)->first();
        $announcement->update($request->all());
        return response()->json($announcement, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Announcement::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

}

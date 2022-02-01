<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Traits\MainTrait;
use Illuminate\Http\Request;
use App\Models\TicketMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    use MainTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $conditions = Gate::allows('isAdmin') ? [] : [['user_id','=',Auth::user()->id]];

      $tickets = Ticket::where($conditions)->orderBy('id','desc')->paginate();
        if($request->api)
        {
            if(isset($request->search))
            $tickets = $this->filter(['conditions'=>$conditions,'table'=>'tickets','class'=>Ticket::class,'search'=>$request->search]);
            return response()->json($tickets, 200);
        }
       return view('admin.tickets',compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isUser');
        $ticket = $request->all();
        $ticket['user_id'] = Auth::user()->id;
        if(isset($ticket['attachment']))
        {
            $file = $ticket['attachment'];
            unset($ticket['attachment']);
            $ticket['file'] = time().$file->getClientOriginalName();
            move_uploaded_file($file->getPathname(),storage_path('uploads').DIRECTORY_SEPARATOR.$ticket['file']);
        }
        $ticket = Ticket::create($ticket);
        return redirect()->back()->with('success_save', true);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::where('id',$id)->first();
        $messages = TicketMessage::where('ticket_id',$id)->orderby('created_at','asc')->get();

        return !$ticket ?  abort(404) : view('admin.tickets-view',compact('ticket','messages'));
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
        $ticket = Ticket::where('id',$id)->get()->first();
        if(!is_null($request->input('status')))
        {
          $this->authorize('isAdmin');
          $ticket->update(['status'=>$request->input('status')]);
        }else{
            $request->validate(['content'=>'required']);
            TicketMessage::create($request->all());
            if(Auth::guard('admin')->check())
            $ticket->update(['status'=>'answered']);
            else 
            $ticket->update(['status'=>'pending']);

        }
        session()->put('success_update', true);
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
        $destroy = Ticket::where('id',$id)->first()->delete();
        return response()->json($destroy, 200);
    }

    public function downloadAttachment($file)
    {
        return response()->download(storage_path('uploads'.DIRECTORY_SEPARATOR.$file));
    }

}

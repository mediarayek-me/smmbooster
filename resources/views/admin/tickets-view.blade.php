@extends('layouts.admin')


@section('content')
<main id="main-container">

    <div class="ticket-area my-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5 ">
                    <div class="bg-white p-2">
                        <div
                            class="font-w600 animated fadeIn bg-body-light px-3 py-2 mb-2 shadow-sm mw-100 border-left  border-right border-dark rounded-right">
                            {{Helper::getLang('Ticket')}} : {{ $ticket->id }}</div>
                        <div
                            class="font-w600 animated fadeIn bg-body-light px-3 py-2 mb-2 shadow-sm mw-100 border-left border-right border-dark rounded-right">
                            {{Helper::getLang('Status')}} :
                            <span
                                class="badge badge-pill @if($ticket->status == 'pending') badge-info @endif @if($ticket->status == 'answered') badge-success @endif @if($ticket->status == 'closed') badge-danger @endif">
                                {{ $ticket->status }}</span>
                        </div>
                        <div
                            class="font-w600 animated fadeIn bg-body-light px-3 py-2 mb-2 shadow-sm mw-100 border-left border-right border-dark rounded-right">
                            {{Helper::getLang('Name')}} : {{ $ticket->name }}</div>
                        <div
                            class="font-w600 animated fadeIn bg-body-light px-3 py-2 mb-2 shadow-sm mw-100 border-left border-right border-dark rounded-right">
                            {{Helper::getLang('Email')}} : {{ $ticket->email }}</div>
                        <div
                            class="font-w600 animated fadeIn bg-body-light px-3 py-2 mb-2 shadow-sm mw-100 border-left border-right border-dark rounded-right">
                            {{Helper::getLang('Created at')}} : {{ $ticket->created_at }}</div>
                       
                        @if (Gate::allows('isAdmin'))
                        <label>{{Helper::getLang('Change Status')}}</label>
                        <form ref="ticket_status" action="{{route('admin.tickets.update',$ticket->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <select v-on:change="updateStatus()"  class="form-control" name="status" value="{{$ticket->status}}">
                                @foreach(Helper::getTicketStatus() as $key => $status)
                                <option value="{{ $status }}"  @if($ticket->status == $status) selected @endif >{{Helper::getLang($status) }}</option>
                                @endforeach
                            </select>
                        </form>
                        @endif
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="bg-white p-2">
                        <div class="block block-rounded">
                            <!-- Chat #1 Header -->
                            <div class="block-content block-content-full bg-primary text-center">
                                <img class="img-avatar img-avatar-thumb"
                                    src="{{asset('images/avatars/'.auth()->user()->avatar)}}"
                                    alt="">
                                <p class="font-size-lg font-w600 text-white mt-3 mb-0">
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                </p>
                                <p class="font-italic text-white-75 mb-0">
                                    {{ Auth::user()->username }}
                                </p>
                            </div>
                            <!-- END Chat #1 Header -->

                            <!-- Chat #1 Messages -->
                            <div class="js-chat-messages block-content block-content-full text-wrap-break-word overflow-y-auto"
                                data-chat-id="1" style="height: 300px;">
                                @if (Gate::allows('isAdmin'))
                                <div class="font-size-sm font-italic text-muted animated fadeIn my-2">{{$ticket->created_at}}</div>
                                <div class="mr-4">
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-dark rounded-right">
                                        {{Helper::getLang('Fullname')}} : {{$ticket->name}} |  {{Helper::getLang('Email')}} : {{$ticket->email}}
                                    </div>
                                   
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-dark rounded-right">
                                        {{Helper::getLang('Subject')}} : {{$ticket->subject}}
                                    </div>
                                    <br>
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-dark rounded-right">
                                        {{Helper::getLang('Message')}} : <br> {!! $ticket->message  !!}
                                    </div>
                                    <br>
                                    @if ($ticket->file)
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-dark rounded-right">
                                        <a  href="download/{{$ticket->file}}">{{Helper::getLang('Attachment file')}}</a>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <div class="text-right ml-4">
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-right border-primary rounded-left text-left">
                                        {{Helper::getLang('Fullname')}} : {{$ticket->name}} |  {{Helper::getLang('Email')}} : {{$ticket->email}}
                                    </div>
                                   
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-right border-primary rounded-left text-left">
                                        {{Helper::getLang('Subject')}} : {{$ticket->subject}}
                                    </div>
                                    <br>
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-right border-primary rounded-left text-left">
                                        {{Helper::getLang('Message')}} : <br> {!! $ticket->message  !!}
                                    </div>
                                    <br>
                                    @if ($ticket->file)
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-right border-primary rounded-left text-left">
                                        <a  href="download/{{$ticket->file}}">{{Helper::getLang('Attachment file')}}</a>
                                    </div>
                                    @endif
                                </div>
                                @endif
                                @foreach ($messages as $message)
                                @if (Gate::allows('isAdmin'))
                                @if ($message->response_by == 'admin')
                                <div class="text-right ml-4">
                                    <div class="font-size-sm font-italic text-muted animated fadeIn my-2">{{$message->created_at}}</div>
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-dark rounded-right">
                                       {!! $message->content  !!}
                                    </div>
                                </div>
                                @else
                                <div class="text-left mr-4">
                                  <div class="font-size-sm font-italic text-muted animated fadeIn my-2">{{$message->created_at}}</div>
                                  <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-right border-dark rounded-left">
                                     {!! $message->content  !!}
                                  </div>
                              </div>
                                @endif
                                @else
                                @if ($message->response_by == 'user')
                                <div class="text-right ml-4">
                                    <div class="font-size-sm font-italic text-muted animated fadeIn my-2">{{$message->created_at}}</div>
                                    <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-left border-dark rounded-right">
                                       {!! $message->content  !!}
                                    </div>
                                </div>
                                @else
                                <div class="text-left mr-4">
                                  <div class="font-size-sm font-italic text-muted animated fadeIn my-2">{{$message->created_at}}</div>
                                  <div class="d-inline-block font-w600 animated fadeIn bg-body-light border-3x px-3 py-2 mb-2 shadow-sm mw-100 border-right border-dark rounded-left">
                                     {!! $message->content  !!}
                                  </div>
                              </div>
                                @endif
                                @endif
                            
                                 
                             
                                @endforeach
                                
                            </div>
                            @if (Gate::allows('isAdmin'))
                            <form action="{{route('admin.tickets.update',$ticket->id)}}" method="post">
                            @else
                            <form action="{{route('user.tickets.update',$ticket->id)}}" method="post">
                            @endif
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                <input type="hidden" name="response_by" value="{{Gate::allows('isAdmin') ? 'admin' : 'user'}}">
                                <div class="js-chat-form block-content p-2 bg-body-dark">
                                    <textarea  id="message" name="content" ></textarea>
                                </div>
                                <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                                    <button type="submit" class="w-100 btn btn-primary">{{Helper::getLang('Send')}}</button>
                                </div>
                            </form>
                            <!-- END Chat #1 Input -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</main>

@endsection

@section('scripts')
@if(session()->has('success_update'))
    @php session()->forget('success_update') @endphp
        <script>
            jQuery(function () {
                window.utilities.notify('success', 'ticket updated successfully');
            })
        </script>
 @endif
<script src="{{ asset('assets/js/be_comp_chat.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins/ckeditor5-classic/build/ckeditor.js') }}"></script>
<script>
        jQuery(function () {
            Dashmix.helpers(['ckeditor5']);
        });

</script>

<script src="{{ asset('js/pages/ticket.js') }}"></script>
@endsection

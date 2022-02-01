<!-- ticket details modal -->
<div class="modal fade mt-4" id="edit-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            @if (Gate::allows('isAdmin'))
            <form ref="from_ticket" id="from-ticket" action="{{route('admin.tickets.store')}}" method="post"  enctype="multipart/form-data">
             @else
            <form ref="from_ticket" id="from-ticket" action="{{route('user.tickets.store')}}" method="post"  enctype="multipart/form-data">
             @endif
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('add new ticket')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="px-3  mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{Helper::getLang('Name')}}</label>
                                    <input  v-model="postdata.name" type="text" class="form-control" id="name" name="name" placeholder="{{Helper::getLang('name')}}">
                                    <div v-if="errors.name" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.name.required">{{Helper::getLang('name is required')}}</span> 
                                      <span v-if="errors.name.over_length">{{Helper::getLang('maximum characters is 100')}}</span>  
                                    </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{Helper::getLang('Email')}}</label>
                                    <input  v-model="postdata.email" type="email" class="form-control" id="email" name="email" placeholder="{{Helper::getLang('email')}}">
                                    <div v-if="errors.email" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.email.required">{{Helper::getLang('email is required')}}</span> 
                                      <span v-if="errors.email.over_length">{{Helper::getLang('maximum characters is 100')}}</span>  
                                    </div>
                                 </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                              <select v-model="postdata.type" class="form-control" name="type" id="type">
                                  <option value="">--{{Helper::getLang('select type')}}--</option>
                                @foreach (Helper::ticketTypes() as $key => $type)
                                    <option value="{{$type}}">{{Helper::getLang($type)}}</option>
                                @endforeach
                              </select>
                              <div v-if="errors.type" class="invalid-feedback m-0 d-block ">
                                <span v-if="errors.type.required">{{Helper::getLang('type is required')}}</span> 
                              </div>
                        </div>
                         <div class="form-group">
                            <label for="subject">{{Helper::getLang('Subject')}}</label>
                            <input  v-model="postdata.subject" type="subject" class="form-control" id="subject" name="subject" placeholder="{{Helper::getLang('subject')}}">
                            <div v-if="errors.subject" class="invalid-feedback m-0 d-block ">
                              <span v-if="errors.subject.required">{{Helper::getLang('subject is required')}}</span> 
                              <span v-if="errors.subject.over_length">{{Helper::getLang('maximum characters is 100')}}</span>  
                            </div>
                         </div>
                         <div class="form-group">
                                 <label for="message">{{Helper::getLang('Message')}}</label>
                                 <textarea  id="message" name="message" ></textarea>
                                 {{-- <ckeditor :editor="editor" v-model="postdata.message"  name="message"></ckeditor> --}}
                                 <div v-if="errors.message" class="invalid-feedback m-0 d-block ">
                                     <span v-if="errors.message.required">{{Helper::getLang('message is required')}}</span> 
                                     <span v-if="errors.message.over_length">{{Helper::getLang('maximum characters is 600')}}</span>  
                                   </div>
                         </div>
                         <div class="form-group">
                                 <a class="btn btn-sm btn-light select-file" href="javascript:void(0)">
                                     <i class="fa fa-file text-muted mr-1"></i>{{Helper::getLang('Attachment file')}}
                                 </a>
                                 <input   v-on:change="getAttachment($event)" ref="attachment"  class="d-none" type="file" name="attachment">
                         </div>
                     </div>
   
                    </div>
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button v-on:click="storeTicket(postdata.id)" type="button" class="w-100 btn btn-primary">{{Helper::getLang('submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
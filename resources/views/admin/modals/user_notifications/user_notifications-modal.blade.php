<!-- user_notification details modal -->
<div class="modal fade mt-4" id="edit-user_notification-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-user_notification"action="{{route('admin.user-notifications.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">@lang('labels.add new Notification')</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="px-3  mt-3">
                        <div class="form-group">
                            <label for="user">{{Helper::getLang('Send Notification To')}}</label>
                              <select v-model="postdata.user_id" class="form-control" name="user" id="user">
                                  <option value="">--{{Helper::getLang('select user')}}--</option>
                                @foreach (Helper::users() as $id => $email)
                                    <option value="{{$id}}">{{$email}}</option>
                                @endforeach
                              </select>
                              <div v-if="errors.user_id" class="invalid-feedback m-0 d-block ">
                                <span v-if="errors.user_id.required">{{Helper::getLang('user is required')}}</span> 
                              </div>
                        </div>
                        <div class="form-group">
                                <label for="subject">{{Helper::getLang('Subject')}}</label>
                                <input  v-model="postdata.subject" type="text" class="form-control" id="subject" name="subject" placeholder="{{Helper::getLang('Question')}}">
                                <div v-if="errors.subject" class="invalid-feedback m-0 d-block ">
                                  <span v-if="errors.subject.required">{{Helper::getLang('subject is required')}}</span> 
                                  <span v-if="errors.subject.over_length">{{Helper::getLang('maximum characters is 250')}}</span>  
                                </div>
                        </div>
                     </div>
   
                    </div>
                    <div class="px-3">
                        <div class="form-group">
                            <label for="content">{{Helper::getLang('Content')}}</label>
                            <ckeditor :editor="editor" v-model="postdata.content" ></ckeditor>
                            <div v-if="errors.content" class="invalid-feedback m-0 d-block ">
                                <span v-if="errors.content.required">{{Helper::getLang('Name is required</span> 
                                <span v-if="errors.content.over_length">maximum characters is 500</span>  
                              </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button v-on:click="storeUserNotification(postdata.id)" type="button" class="w-100 btn btn-primary">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
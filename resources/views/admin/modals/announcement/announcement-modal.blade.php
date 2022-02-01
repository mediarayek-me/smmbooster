<!-- announcement details modal -->
<div class="modal fade mt-4" id="edit-announcement-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-announcement"action="{{route('admin.announcements.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('add new announcement')}}</h3>
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
                                    <label for="type">{{Helper::getLang('Type')}}</label>
                                    <select v-model="postdata.type" class="form-control" name="type" id="type">
                                        @foreach (Helper::announcementTypes() as $key => $type)
                                        <option value="{{$type}}">{{Helper::getLang($type)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{Helper::getLang('Status')}}</label>
                                      <select v-model="postdata.status" class="form-control" name="status" id="status">
                                        @foreach (Helper::status() as $key => $status)
                                            <option value="{{$key}}">{{Helper::getLang($status)}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="px-3  mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start">{{Helper::getLang('Start')}}</label>
                                    <input v-model="postdata.start"  type="text" class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input active" id="start_date" name="start_date" placeholder="Y-m-d" readonly="readonly">
                                    <div v-if="errors.start" class="invalid-feedback m-0 d-block ">
                                        <span v-if="errors.start.required">{{Helper::getLang('Start date is required')}}</span> 
                                      </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end">{{Helper::getLang('End')}}</label>
                                    <input v-model="postdata.end"  type="text" class="js-flatpickr form-control bg-white js-flatpickr-enabled flatpickr-input active" id="end_date" name="end_date" placeholder="Y-m-d" readonly="readonly">
                                    <div v-if="errors.end" class="invalid-feedback m-0 d-block ">
                                        <span v-if="errors.end.required">{{Helper::getLang('End date is required')}}</span> 
                                      </div>
                                </div>
                            </div>
                        </div>
                     </div>
   
                    </div>
                    <div class="px-3">
                        <div class="form-group">
                            <label for="description">{{Helper::getLang('Description')}}</label>
                            <ckeditor :editor="editor" v-model="postdata.description" ></ckeditor>
                             <div v-if="errors.description" class="invalid-feedback m-0 d-block ">
                                <span v-if="errors.description.required">{{Helper::getLang('Description is required')}}</span> 
                              </div>
                            </div>
                    </div>
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button v-on:click="storeAnnouncement(postdata.id)" type="button" class="w-100 btn btn-primary">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<!-- faq details modal -->
<div class="modal fade mt-4" id="edit-faq-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-faq"action="{{route('admin.faqs.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">@lang('labels.add new Question')</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="px-3  mt-3">
                        <div class="form-group">
                                <label for="question">Question</label>
                                <input  v-model="postdata.question" type="text" class="form-control" id="question" name="question" placeholder="Question">
                                <div v-if="errors.question" class="invalid-feedback m-0 d-block ">
                                  <span v-if="errors.name.required"> Name is required</span> 
                                  <span v-if="errors.name.over_length">maximum characters is 250</span>  
                                </div>
                        </div>
                     </div>
   
                    </div>
                    <div class="px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                      <select v-model="postdata.status" class="form-control" name="status" id="status">
                                        @foreach (Helper::status() as $key => $status)
                                            <option value="{{$key}}">{{$status}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort">Sorting number</label>
                                    <input v-model="postdata.sort" value="0" type="number" class="form-control" id="sort" name="sort" placeholder="sorting number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-3">
                        <div class="form-group">
                            <label for="answer">Answer</label>
                            <ckeditor :editor="editor" v-model="postdata.answer" ></ckeditor>
                            <div v-if="errors.answer" class="invalid-feedback m-0 d-block ">
                                <span v-if="errors.answer.required"> Name is required</span> 
                                <span v-if="errors.answer.over_length">maximum characters is 800</span>  
                              </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button v-on:click="storeFaq(postdata.id)" type="button" class="w-100 btn btn-primary">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
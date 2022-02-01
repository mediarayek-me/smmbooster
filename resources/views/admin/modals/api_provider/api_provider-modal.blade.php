<!-- api_provider details modal -->
<div class="modal fade mt-4" id="edit-api_provider-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-api_provider"action="{{route('admin.categories.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('Add New API')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="px-3  mt-3">
                        <div class="form-group">
                                <label for="name">{{Helper::getLang('Name')}}</label>
                                <input  v-model="postdata.name" type="text" class="form-control" id="name" name="name" placeholder="{{Helper::getLang('Api provider name')}}">
                                <div v-if="errors.name" class="invalid-feedback m-0 d-block ">
                                  <span v-if="errors.name.required">{{Helper::getLang('Name is required')}}</span> 
                                  <span v-if="errors.name.over_length">{{Helper::getLang('maximum characters is 150')}}</span>  
                                </div>
                        </div>
                     </div>
   
                    </div>
                    <div class="px-3">
                                <div class="form-group">
                                    <label for="url">{{Helper::getLang('URL')}}</label>
                                    <input v-model="postdata.url"  type="text" class="form-control" id="url" name="url" placeholder="{{Helper::getLang('url')}}">
                                    <div v-if="errors.url" class="invalid-feedback m-0 d-block ">
                                        <span v-if="errors.url.required">{{Helper::getLang('url is required')}}</span>
                                        <span v-if="errors.url.url_not_valid">{{Helper::getLang('url not valid')}}</span>
                                    </div>
                                </div>
                    </div>
                    <div class="px-3">
                        <div class="form-group">
                            <label for="api_key">{{Helper::getLang('Api key')}}</label>
                            <input v-model="postdata.api_key"  type="text" class="form-control" id="api_key" name="api_key" placeholder="{{Helper::getLang('api key')}}">
                            <div v-if="errors.api_key" class="invalid-feedback m-0 d-block ">
                                <span v-if="errors.api_key.required">{{Helper::getLang('api key is required')}}</span>
                            </div>
                        </div>
            </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="px-3">
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
                        <div class="col-md-6">
                            <div class="px-3">
                                <div class="form-group">
                                    <label for="percentage_increase">{{Helper::getLang('Price percentage increase')}}</label>
                                      <select v-model="postdata.percentage_increase" class="form-control" name="percentage_increase" id="percentage_increase">
                                        @foreach (Helper::percentageIncrease() as $key => $percentage_increase)
                                            <option value="{{$key}}">{{$percentage_increase}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-3">
                        <div class="form-group">
                            <label for="notes">{{Helper::getLang('notes')}}</label>
                             <textarea v-model="postdata.notes" class="form-control" name="notes" id="notes" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center block-content block-content-full text-right">
                        <button :disabled="processing" v-on:click="storeApiProvider(postdata.id)" type="button" class="w-100 btn btn-primary">{{Helper::getLang('Submit')}}<i v-if="processing" class="fa ml-2 fa-sync fa-spin"></i></button>
                  </div>
                </div>
            </form>
        </div>
    </div>
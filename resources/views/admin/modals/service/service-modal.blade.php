<!-- service details modal -->
<div class="modal fade mt-4" id="edit-service-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-service"action="{{route('admin.services.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('Add New Service')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="px-3  mt-3">
                        <div class="form-group">
                                <label for="name">{{Helper::getLang('Name')}}</label>
                                <input  v-model="postdata.name" type="text" class="form-control" id="name" name="name" placeholder="{{Helper::getLang('Service name')}}">
                                <div v-if="errors.name" class="invalid-feedback m-0 d-block ">
                                  <span v-if="errors.name.required">{{Helper::getLang('Name is required')}}</span> 
                                  <span v-if="errors.name.over_length">{{Helper::getLang('maximum characters is 150')}}</span>  
                                </div>
                        </div>
                     </div>
                    <div class="row px-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">{{Helper::getLang('Type')}}</label>
                                  <select  v-model="postdata.type" class="form-control" name="type" id="type">
                                    <option value="normal">{{Helper::getLang('Normal')}}</option>
                                    <option value="api">{{Helper::getLang('Api')}}</option>
                                  </select>
                            </div>
                    </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{Helper::getLang('Category')}}</label>
                                      <select  v-model="postdata.category_id" class="form-control" name="category_id" id="category_id">
                                        <option value="" >{{Helper::getLang('Select Category')}}</option>
                                        @foreach ($categories as $category)
                                        <option value={{$category->id}}>{{$category->name}}</option>
                                        @endforeach
                                      </select>
                                      <div v-if="errors.category_id" class="invalid-feedback m-0 d-block ">{{Helper::getLang('Category is required')}}</div>
                                </div>
                        </div>
                    
                    </div>
                    <div class="px-3" v-if="postdata.type == 'api'">
                        <div class="form-group">
                            <label for="api-provider">{{Helper::getLang('Api provider')}}</label>
                              <select v-model="postdata.api_provider_id"  class="form-control" name="provider_id" id="provider-id">
                                @foreach (Helper::api_providers() as $key => $api_providers)
                               <option value="{{$key}}">{{$api_providers}}</option>
                                 @endforeach
                              </select>
                              <div v-if="errors.api_provider_id" class="invalid-feedback m-0 d-block ">{{Helper::getLang('Api provider is required')}}</div>

                        </div>
                    </div>
                    <div class="px-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="min">{{Helper::getLang('Minimum Amount')}}</label>
                                    <input :disabled = "postdata.api_provider_id && postdata.id" v-model="postdata.min"  type="number" class="form-control" id="min" name="min" placeholder="{{Helper::getLang('Minimum Amount')}}">
                                    <div v-if="errors.min" class="invalid-feedback m-0 d-block ">Minimum Amount is required</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="max">{{Helper::getLang('Max Amount')}}</label>
                                    <input :disabled = "postdata.api_provider_id && postdata.id" v-model="postdata.max"    type="number" class="form-control" id="max" name="max" placeholder="{{Helper::getLang('Maximum Amount')}}">
                                    <div v-if="errors.max" class="invalid-feedback m-0 d-block ">Maximum Amount is required</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rate">{{Helper::getLang('Rate per 1000')}}</label>
                                    <input :disabled = "postdata.api_provider_id && postdata.id" v-model="postdata.rate"   type="number" class="form-control" id="rate" name="rate" placeholder="{{Helper::getLang('Rate per 1000')}}">
                                    <div v-if="errors.rate" class="invalid-feedback m-0 d-block ">Rate per 1000 is required</div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div :class="{'col-md-6' : postdata.type == 'api', 'col-md-12' : postdata.type != 'api'}" >
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
                        <div class="col-md-6"  v-if="postdata.type == 'api'">
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
                            <label for="description">{{Helper::getLang('Description')}}</label>
                             <textarea v-model="postdata.description" class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button v-on:click="storeService(postdata.id)" type="button" class="w-100 btn btn-primary">{{Helper::getLang('submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  
  </div>
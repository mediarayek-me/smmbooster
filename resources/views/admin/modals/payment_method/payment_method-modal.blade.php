<!-- payment-method details modal -->
<div class="modal fade mt-4" id="edit-payment-method-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-payment-method"action="{{route('admin.payment-methods.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('Modify Payment Method')}}</h3>
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
                                    <input  v-model="postdata.name" type="text" class="form-control" id="name" name="name" placeholder="{{Helper::getLang('Payment Method Name')}}">
                                    <div v-if="errors.name" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.name.required">{{Helper::getLang('Name is required')}}</span> 
                                      <span v-if="errors.name.over_length">{{Helper::getLang('maximum characters is 150')}}</span>  
                                    </div>
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
                     <div class="px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minimalpayment">{{Helper::getLang('Minimal payment')}}</label>
                                    <input v-model="postdata.min" value="0" type="number" class="form-control" id="min" name="min" placeholder="{{Helper::getLang('Minimal payment')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maximalpayment">{{Helper::getLang('Maximal payment')}}</label>
                                    <input v-model="postdata.max" value="0" type="number" class="form-control" id="max" name="max" placeholder="{{Helper::getLang('Maximal payment')}}">
                                </div>
                            </div>
                         </div>
                     </div>
                     <div class="px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fee">{{Helper::getLang('Transaction fee')}}</label>
                                    <input v-model="postdata.fee" value="0" type="number" class="form-control" id="fee" name="fee" placeholder="{{Helper::getLang('fee %')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="environment">{{Helper::getLang('Environment')}}</label>
                                    <select v-model="postdata.environment" class="form-control" name="environment" id="environment">
                                        @foreach (['sandbox'=>'sandbox','production'=>'production'] as $key => $environment)
                                            <option value="{{$key}}">{{Helper::getLang($environment)}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                        </div>
                        </div>
               
                    <div class="px-3">
                        <div class="row">
                            <div  v-if="postdata.id == 2" class="col-md-12">
                                <div class="form-group">
                                    <label for="api_key">{{Helper::getLang('API key')}}</label>
                                    <input v-model="postdata.api_key" type="text" class="form-control" id="api_key" name="api_key" placeholder="{{Helper::getLang('API key')}}">
                                </div>
                            </div>
                            <div  v-if="postdata.id == 1" class="col-md-12">
                                <div class="form-group">
                                    <label for="client_id">{{Helper::getLang('Client ID')}}</label>
                                    <input v-model="postdata.client_id" type="text" class="form-control" id="client_id" name="client_id" placeholder="{{Helper::getLang('Client ID')}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="private_key">{{Helper::getLang('Private key')}}</label>
                                    <input v-model="postdata.private_key" type="text" class="form-control" id="private_key" name="secret_key" placeholder="{{Helper::getLang('secret key')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button v-on:click="storePaymentMethod(postdata.id)" type="button" class="w-100 btn btn-primary">{{Helper::getLang('submit')}}</button>
                    </div>
                </div>
             
            </form>
        </div>
        </div>
    </div>
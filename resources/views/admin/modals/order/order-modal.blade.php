<!-- service details modal -->
    <div class="modal fade" id="add-order-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-order"action="{{route('admin.orders.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('add new order')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
              
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8 mt-3">
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">{{Helper::getLang('Category')}}</label>
                                      <select v-on:change="getServices()"  v-model="category_id" class="form-control" name="category_id" id="category_id">
                                        <option value="" >{{Helper::getLang('Select Category')}}</option>
                                        @foreach ($categories as $category)
                                        <option value={{$category->id}}>{{$category->name}}</option>
                                        @endforeach
                                      </select>
                                      <div v-if="errors.category_id" class="invalid-feedback m-0 d-block ">{{Helper::getLang('category is required')}}</div>
                                </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label for="service">{{Helper::getLang('Service')}}</label>
                                   <select  v-on:change='setService()' v-model="postdata.service_id" class="form-control" name="service_id" id="service_id">
                                     <option value="" >{{Helper::getLang('Select Service')}}</option>
                                     <option v-for="service in services" v-bind:value="service.id">@{{service.name}}</option>
                                   </select>
                                   <div v-if="errors.service_id" class="invalid-feedback m-0 d-block ">{{Helper::getLang('service is required')}}</div>
                             </div>
                         </div>
                          </div>
                        <div class="form-group">
                                <label for="link">{{Helper::getLang('Link')}}</label>
                                <input  :disabled="!selected_service" v-model="postdata.link" type="text" class="form-control" id="link" name="link" placeholder="{{Helper::getLang('link')}}">
                                <div v-if="errors.link" class="invalid-feedback m-0 d-block ">
                                    <span v-if="errors.link.required">{{Helper::getLang('link is required')}}</span>
                                    <span v-if="errors.link.link_not_valid">{{Helper::getLang('link not valid')}}</span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="quantity">{{Helper::getLang('Quantity')}}</label>
                                <input :disabled="!selected_service"  v-on:input="getTotalPrice()" v-model="postdata.quantity" type="number" class="form-control" id="quantity" name="quantity" placeholder="{{Helper::getLang('quantity')}}">
                                <div v-if="errors.quantity" class="invalid-feedback m-0 d-block ">
                                    <span v-if="errors.quantity.required">{{Helper::getLang('quantity is required')}}</span>
                                    <span v-if="errors.quantity.maximum">{{Helper::getLang('quantity must be less than or equal to maximum amount')}}</span>
                                    <span v-if="errors.quantity.minimum">{{Helper::getLang('quantity must be greater than or equal to minimum amount')}}</span>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="notes">{{Helper::getLang('Notes')}}</label>
                            <textarea  :disabled="!selected_service" class="form-control" v-model="postdata.notes" name="notes" id="notes" cols="30" rows="5"></textarea>
                    </div>
                        <div class="custom-control custom-checkbox custom-control-inline custom-control-primary">
                            <input  v-model="confirmation"  type="checkbox" class="custom-control-input" id="order-confirmation" name="order-confirmation">
                            <label class="custom-control-label text-uppercase" for="order-confirmation">{{Helper::getLang('I have confirmed this order')}}</label>
                            <div v-if="errors.confirmation" class="invalid-feedback m-0 d-block ">{{Helper::getLang('confirmation is required')}}</div>

                        </div>
                        </div>
                    <div class="col-md-4  border-left">
                        <div class="container p-3">
                            <h4 class="text-center text-primary"> <i class="fas fa-store-alt mx-2"></i>{{Helper::getLang('Order Resume')}}</h4>
                            <div v-if="selected_service">
                            <div class="py-1"><strong>{{Helper::getLang('name')}} : </strong> @{{selected_service.name}}</div>
                            <div class="py-1"><strong>{{Helper::getLang('min')}} : </strong> @{{selected_service.min}}</div>
                            <div class="py-1"><strong>{{Helper::getLang('max')}} :</strong> @{{selected_service.max}}</div>
                            <div class="py-1"><strong>{{Helper::getLang('rate')}} :</strong> @{{selected_service.rate}}</div>
                            <div class="py-1"><strong>{{Helper::getLang('total price')}} :</strong> @{{total_price}}</div>
                            <div class="py-1"><strong>{{Helper::getLang('description')}} :</strong> </div>
                            <div class="py-1" style="height: 300px;overflow: auto;">
                                <p class="text-left">
                                    @{{selected_service.description}}
                                </p>
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
             
                </div>
  
                
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button :disabled="processing" v-on:click="storeOrder(postdata.id)" type="button" class="w-100 btn btn-primary">{{Helper::getLang('Place Order')}} <i v-if="processing" class="fa ml-2 fa-sync fa-spin"></i></button>
                    </div>
               
                </form>
                </div>
            </div>
    </div>
  
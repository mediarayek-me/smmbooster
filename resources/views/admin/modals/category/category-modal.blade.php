<!-- category details modal -->
<div class="modal fade mt-4" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-category"action="{{route('admin.categories.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('add new category')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="px-3  mt-3">
                        <div class="form-group">
                                <label for="name">{{Helper::getLang('Name')}}</label>
                                <input  v-model="postdata.name" type="text" class="form-control" id="name" name="name" placeholder="{{Helper::getLang('Category name')}}">
                                <div v-if="errors.name" class="invalid-feedback m-0 d-block ">
                                  <span v-if="errors.name.required">{{Helper::getLang('Name is required')}}</span> 
                                  <span v-if="errors.name.over_length">{{Helper::getLang('maximum characters is 150')}}</span>  
                                </div>
                        </div>
                     </div>
   
                    </div>
                    <div class="px-3">
                        <div class="row">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort">{{Helper::getLang('Sorting number')}}</label>
                                    <input v-model="postdata.sort" value="0" type="number" class="form-control" id="sort" name="sort" placeholder="{{Helper::getLang('sorting number')}}">
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
                        <button v-on:click="storeCategory(postdata.id)" type="button" class="w-100 btn btn-primary">{{Helper::getLang('submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
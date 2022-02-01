<!-- language details modal -->
<div class="modal fade mt-4" id="edit-language-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form ref="form"  id="from-language"action="{{route('admin.languages.store')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <input v-model="postdata.id"  type="hidden" name="id">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('add new Language')}}</h3>
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
                                    <input  v-model="postdata.name" type="text" class="form-control" id="name" name="name" placeholder="Name">
                                    <div v-if="errors.name" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.name.required">{{Helper::getLang('Name is required')}}</span> 
                                      <span v-if="errors.name.over_length">{{Helper::getLang('maximum characters is 100')}}</span>  
                                    </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">{{Helper::getLang('Code')}}</label>
                                    <input  v-model="postdata.code" type="text" class="form-control" id="code" name="code" placeholder="{{Helper::getLang('Code')}}">
                                    <div v-if="errors.code" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.code.required">{{Helper::getLang('Code is required')}}</span> 
                                      <span v-if="errors.code.over_length">{{Helper::getLang('maximum characters is 10')}}</span>  
                                    </div>
                            </div>
                            </div>
                        </div>
                     </div>
   
                    </div>
                    <div class="px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">{{Helper::getLang('Direction')}}</label>
                                      <select v-model="postdata.direction" class="form-control text-uppercase" name="direction" id="direction">
                                        @foreach (['ltr','rtl'] as $direction)
                                            <option  value="{{$direction}}">{{Helper::getLang($direction)}}</option>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="d-none" ref="image"  v-on:change='setImage($event)' type="file" id="image" name="image">
                                    <button v-on:click="selectImage()" type="button" class="btn btn-primary btn-sm">{{Helper::getLang('Select Image')}}</button>
                                    <label ref="label"></label>
                                    <div v-if="errors.image" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.image.required">{{Helper::getLang('image is required')}}</span> 
                                    </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input  v-model="postdata.status"  type="hidden" ref="status" name="status">
                                        <input  v-model="postdata.status" type="checkbox" class="custom-control-input" id="status"  >
                                        <label class="custom-control-label" for="status">{{Helper::getLang('Status')}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-control-inline">
                                        <input  v-model="postdata.is_default"  type="hidden" name="is_default">
                                        <input  v-model="postdata.is_default"  type="checkbox" class="custom-control-input" ref="is_default" id="is_default"  >
                                        <label class="custom-control-label" for="is_default">{{Helper::getLang('is default')}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button v-on:click="storeLanguage(postdata.id)" type="button" class="w-100 btn btn-primary">{{Helper::getLang('submit')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
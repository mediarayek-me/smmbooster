<!-- user details modal -->
<div class="modal fade mt-4" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-user"action="{{route('admin.users.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('add new user')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mx-3 mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{Helper::getLang('firstname')}}</label>
                                    <input  v-model="postdata.firstname" type="text" class="form-control" id="firstname" name="firstname" placeholder="{{Helper::getLang('Firstname')}}">
                                    <div v-if="errors.firstname" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.firstname.required">{{Helper::getLang('firstname is required')}}</span> 
                                    </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{Helper::getLang('lastname')}}</label>
                                    <input  v-model="postdata.lastname" type="text" class="form-control" id="lastname" name="lastname" placeholder="{{Helper::getLang('Lastname')}}">
                                    <div v-if="errors.lastname" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.lastname.required">{{Helper::getLang('lastname is required')}}</span> 
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{Helper::getLang('username')}}</label>
                                    <input  v-model="postdata.username" type="text" class="form-control" id="username" name="username" placeholder="{{Helper::getLang('Username')}}">
                                    <div v-if="errors.username" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.username.required">{{Helper::getLang('username is required')}}</span> 
                                      <span v-if="errors.username.taken">
                                          <span v-for="e in errors.username.taken" >@{{e}}</span>
                                      </span> 

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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">{{Helper::getLang('email')}}</label>
                                    <input  v-model="postdata.email" type="text" class="form-control" id="email" name="email" placeholder="{{Helper::getLang('Email')}}">
                                    <div v-if="errors.email" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.email.required">{{Helper::getLang('email is required')}}</span> 
                                      <span v-if="errors.email.taken">
                                        <span v-for="e in errors.email.taken" >@{{e}}</span>
                                    </span>
                                    </div>
                              </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">{{Helper::getLang('password')}}</label>
                                    <input  v-model="postdata.password" type="password" class="form-control" id="password" name="password" placeholder="{{Helper::getLang('password')}}">
                                    <div v-if="errors.password" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.password.required">{{Helper::getLang('password is required')}}</span> 
                                      <span v-if="errors.password.minimum">{{Helper::getLang('password should have minimum 8 characters')}}</span>  
                                    </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{Helper::getLang('confirm password')}}</label>
                                    <input  v-model="confirm_password" type="password" class="form-control" id="confirm password" name="confirm password" placeholder="{{Helper::getLang('confirm password')}}">
                                    <div v-if="errors.confirm_password" class="invalid-feedback m-0 d-block ">
                                      <span v-if="errors.confirm_password.required">{{Helper::getLang('confirm password is required')}}</span> 
                                      <span v-if="errors.confirm_password.notmatch">{{Helper::getLang('password didn\'t match')}}</span>  

                                    </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort">{{Helper::getLang('Address')}}</label>
                                    <input v-model="postdata.address" type="text" class="form-control" id="address" name="address" placeholder="{{Helper::getLang('Address')}}">
                                    <div v-if="errors.address" class="invalid-feedback m-0 d-block ">
                                        <span v-if="errors.address.required">{{Helper::getLang('address is required')}}</span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sort">{{Helper::getLang('Phone')}}</label>
                                    <input v-model="postdata.phone" type="text" class="form-control" id="phone" name="phone" placeholder="{{Helper::getLang('Phone')}}">
                                    <div v-if="errors.phone" class="invalid-feedback m-0 d-block ">
                                        <span v-if="errors.phone.required">{{Helper::getLang('phone is required')}}</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-md-12">
                            <div class="form-group">
                                <label for="notes">{{Helper::getLang('Notes')}}</label>
                                 <textarea v-model="postdata.notes" class="form-control" name="note" id="note" cols="30" rows="5"></textarea>
                            </div>
                           </div>
                        </div>
                        <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                            <button v-on:click="storeUser(postdata.id)" type="button" class="w-100 btn btn-primary">{{Helper::getLang('submit')}}</button>
                        </div>
                    </div>
                     </div>
   
                    </div>
                
                  
                </div>
            </form>
        </div>

<!-- service details modal -->
<div class="modal fade" id="edit-order-modal" tabindex="-1" role="dialog" aria-labelledby="modal-block-large"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form id="from-order">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">@lang('labels.edit order')</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="link">Order ID</label>
                                    <input disabled v-model="postdata.id" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Type">Type</label>
                                    <input disabled v-model="postdata.type" type="text" class="form-control">

                                </div>
                                <div class="form-group">
                                    <label for="User">User</label>
                                    <input disabled v-model="postdata.user" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="service">Service ID</label>
                                    <input disabled v-model="postdata.service_id" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="service">Service Name</label>
                                    <input disabled v-model="postdata.service_name" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                      <select v-model="postdata.status" class="form-control" name="status" id="status">
                                        @foreach (Helper::orderStatus() as $key => $status)
                                            <option value="{{$status}}">{{$status}}</option>
                                        @endforeach
                                      </select>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>


                <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                    <button v-on:click="updateOrder(postdata.id)" type="button" class="w-100 btn btn-primary">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

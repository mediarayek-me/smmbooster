<!-- transaction details modal -->
<div class="modal fade mt-4" id="edit-transaction-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-transaction"action="{{route('admin.transactions.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">@lang('labels.add new transaction')</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transaction_id">Transaction ID</label>
                                    <input  disabled v-model="postdata.transaction_id"  type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Transaction ID">
                                    
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method">Payment method</label>
                                      <select disabled v-model="postdata.method_id"   class="form-control" name="payment_method" id="Payment Method">
                                        @foreach (Helper::payment_methods() as $key => $payment_method)
                                            <option value="{{$key}}">{{$payment_method}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input disabled  v-model="postdata.amount" type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
                                  </div>
                            </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fee">Fee</label>
                                    <input disabled  v-model="postdata.fee" type="text" class="form-control" id="fee" name="fee" placeholder="Fee">
                                  </div>
                              </div>
                        </div>
                        <div class="form-group">
                            <label for="user_email">User email</label>
                            <input  disabled  v-model="postdata.user_email"  type="text" class="form-control" id="user_email" name="user_email" placeholder="User">
                       </div>
                      
                      <div class="form-group">
                        <label for="status">Status</label>
                          <select v-model="postdata.status" class="form-control" name="status" id="status">
                            @foreach (Helper::transactionStatus() as $key => $status)
                                <option value="{{$key}}">{{$status}}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                         <textarea v-model="postdata.notes" class="form-control" name="notes" id="notes" cols="30" rows="5"></textarea>
                    </div>
                    </div>
   
                    </div>
                    
                    <div class="d-flex justify-content-center block-content block-content-full text-right bg-light">
                        <button v-on:click="storeTransaction(postdata.id)" type="button" class="w-100 btn btn-primary">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
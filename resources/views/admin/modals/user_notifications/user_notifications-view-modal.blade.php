<!-- user_notification details modal -->
<div class="modal fade mt-4" id="edit-user_notification-view-modal" tabindex="-1" role="dialog" aria-labelledby="modal-details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-slideleft" role="document">
        <div class="modal-content">
            <form  id="from-user_notification"action="{{route('admin.user-notifications.store')}}" method="post">
                @csrf
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">{{Helper::getLang('view notification')}}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="px-3  mt-3">
                        <div class="form-group">
                            <label for="user">To</label>
                              <div v-if="postdata.user" class="form-control"  v-html="postdata.user.email"></div>
                        </div>
                        <div class="form-group">
                                <label for="subject">{{Helper::getLang('Subject')}}</label>
                                <div  class="form-control"  v-html="postdata.subject"></div>

                               
                        </div>
                        <div class="form-group">
                            <label for="content">{{Helper::getLang('Content')}}</label>
                            <div  class="form-control"  v-html="postdata.content"></div>

                        </div>
                     </div>
   
                    </div>
                </div>
            </form>
        </div>
    </div>
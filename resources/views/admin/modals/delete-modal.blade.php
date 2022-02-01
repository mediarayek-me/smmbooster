<div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-danger">
                    <h3 class="block-title">{{Helper::getLang('Delete')}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <p>{{Helper::getLang($message)}}</p>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">{{Helper::getLang('No')}}</button>
                    <button  v-on:click="deleteItem()" type="button" class="btn btn-sm btn-danger">{{Helper::getLang('Yes')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
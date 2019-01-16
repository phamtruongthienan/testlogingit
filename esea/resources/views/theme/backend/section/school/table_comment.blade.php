<!-- List modal comment -->
<div class="modal fade" id="modal-comment-list" data-backdrop="static">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Danh sách đánh giá
                </h4>
            </div>
            <div class="modal-body">
                <div class="control-row table-responsive">
                    <table class="table table-bordered table-striped table-dynamic table-dynamic-comment nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="text-center" width="100px">ID</th>
                            <th class="text-center">Tên</th>
                            <th class="text-center" width="200px">Địa chỉ</th>
                            <th class="text-center" width="200px">Ngày</th>
                            <th class="text-center" width="400px">Nội dung</th>
                            <th class="text-center" width="100px">Đánh giá</th>
                            <th class="text-center" width="100px">Phản hồi</th>
                            <th class="text-center" width="100px"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- List modal course  -->



<!-- List modal comment -->
<div class="modal fade" id="modal-comment-reply" data-backdrop="static">
        <div class="modal-dialog" style="width:90%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <i class="fas fa-child"></i>
                        Phản hồi
                    </h4>
                </div>
                <div class="modal-body">
                        <form class="form-horizontal" id="CommentReplyForm" role="form" data-toggle="validator">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="action" id="action" value="reply">
                            <div class="form-group">
                                <label for="inputAddDescribe"
                                        class="col-sm-2 control-label">Miêu tả</label>
                                <div class="col-sm-10">
                                                        <textarea class="textarea form-control" id="content" name="content" placeholder="" style="width: 100%;" rows="6"
                                                                    required data-required-error="Miêu tả không được trống."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                        <button type="button" class="btn btn-primary" id="addCommentReply"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- List modal course  -->